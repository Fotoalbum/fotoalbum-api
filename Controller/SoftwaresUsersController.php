<?php
/**
 * Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('UsersController', 'Users.Controller');

/**
 * Users Users Controller
 *
 * @package       Users
 * @subpackage    Users.Controller
 * @property	  AuthComponent $Auth
 * @property	  CookieComponent $Cookie
 * @property	  PaginatorComponent $Paginator
 * @property	  SecurityComponent $Security
 * @property	  SessionComponent $Session
 * @property	  User $User
 * @property	  RememberMeComponent $RememberMe
 */
class SoftwaresUsersController extends UsersController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'SoftwaresUsers';
	
	// -------------------------------------------------------------------

	/**
	*       beforeFilter
	*
	*       Add all allow
	*	*       @return         ArrayCollection
	**/
	function beforeFilter() 
	{
		parent::beforeFilter();

		$this->autoRender = true;
		
		$this->Auth->Allow('register');
		
		$this->Security->unlockedActions = array('register');
		
		if (!empty($this->request->data))
		{
			if (!isset($this->request->data['User']['email']))
			{
				if (isset($this->request->data['email']))
				{
					$this->request->data['User'] = $this->request->data;
				}
			}
			$this->request->data[$this->modelClass] = $this->request->data['User'];
		}
		
		Configure::write('Config.language', 'nld');	
		$this->Session->write('Config.language', 'nld');  
				

    }
	
	public function register()
	{
		Configure::write('debug', 0);
		if ($this->Auth->user()) {
			$return_data['result']	= 'ERROR';
			$return_data['msg']		= __d('users', 'You are already registered and logged in!');
			$return_data['data']   = array();				
			die(json_encode($return_data));				
		}
		
		if (!empty($this->request->data)) {
			$user = $this->User->register($this->request->data);
			if ($user !== false) {
				$user_data = $user;
				if ($user === true)
				{
					$user_data = $this->User->read(null,$this->User->id);
				}
				$user_data['SoftwaresUser'] = $user_data['User'];
				$this->_sendVerificationEmail($user_data);
				$return_data['result']	= 'OK';
				$return_data['msg']		= __d('users', 'Your account has been created. You should receive an e-mail shortly to authenticate your account. Once validated you will be able to login.');
				$return_data['data']   = $user_data;				
				die(json_encode($return_data));					
			} else {
				unset($this->request->data['User']['password']);
				unset($this->request->data['User']['temppassword']);
				$return_data['result']	= 'ERROR';
				$return_data['msg']		= __d('users', 'Your account could not be created. Please, try again. ');
				$return_data['data'] 	= $this->User->validationErrors;		
				die(json_encode($return_data));					
			}
		}
	}
	
/**
 * Common login action
 *
 * @return void
 */
	public function login($id = false) {
		  if ($this->request->is('post')) {
			$return_data = array();
			//$this->Auth->login(array('id'=>$id));
			if ($this->Auth->login()) {
				$this->getEventManager()->dispatch(new CakeEvent('Users.afterLogin', $this, array('isFirstLogin' => !$this->Auth->user('last_login'))));
				$user_data 									= $this->User->read(null,$this->Auth->user('id'));
				$token 										= md5($user_data['User']['username']); //$this->User->generateToken(50);
				$update_data								= $user_data;
				$update_data['User']['last_login']			= date('Y-m-d H:i:s');
				$update_data['User']['sso_token']			= $token;
				$update_data['User']['sso_token_expires']	= (time() + (1 * 60)); //$this->User->emailTokenExpirationTime();
				$this->User->save($update_data);

				$this->Session->setFlash(sprintf(__d('users', '%s you have successfully logged in'), $this->Auth->user('username')));
				/*
				if (!empty($this->request->data)) {
					$data = $this->request->data[$this->modelClass];
					if (empty($this->request->data[$this->modelClass]['remember_me'])) {
						$this->RememberMe->destroyCookie();
					} else {
						$this->_setCookie();
					}
				}
				*/
				
				$return_data['result']		= 'OK';
				$return_data['msg']			= sprintf(__d('users', '%s you have successfully logged in'), $this->Auth->user('username'));
				$return_data['data']		= $user_data;
				$url = 'http://new.xhibit.com/users/desktop_login/';				
				if (isset($this->data['url']))
				{
					$url = $this->data['url'];
				}
				$return_data['sso_data']	= array('url'=>$url.$this->Auth->user('id').'/'.$token,'id'=>$this->Auth->user('id'),'token'=>$token);
				die(json_encode($return_data));
			} else {
				$return_data['result']	= 'ERROR';
				$return_data['msg']		= __d('users', 'Invalid e-mail / password combination.  Please try again');
				$return_data['data']   = array();				
				die(json_encode($return_data));				
			}
		}
		
		if (isset($this->request->params['named']['return_to'])) {
			$this->set('return_to', urldecode($this->request->params['named']['return_to']));
		} else {
			$this->set('return_to', false);
		}
		$allowRegistration = Configure::read('Users.allowRegistration');
		$this->set('allowRegistration', (is_null($allowRegistration) ? true : $allowRegistration));
	}	
	

/**
 * Sets the cookie to remember the user
 *
 * @param array RememberMe (Cookie) component properties as array, like array('domain' => 'yourdomain.com')
 * @param string Cookie data keyname for the userdata, its default is "User". This is set to User and NOT using the model alias to make sure it works with different apps with different user models across different (sub)domains.
 * @return void
 * @link http://book.cakephp.org/2.0/en/core-libraries/components/cookie.html
 * @deprecated Use the RememberMe Component
 */
	protected function _setCookie($options = array(), $cookieKey = 'rememberMe') {
		$this->RememberMe->settings['cookieKey'] = $cookieKey;
		$this->RememberMe->configureCookie($options);
		return $this->RememberMe->setCookie();
	}
/**
 * Reset Password Action
 *
 * Handles the trigger of the reset, also takes the token, validates it and let the user enter
 * a new password.
 *
 * @param string $token Token
 * @param string $user User Data
 * @return void
 */
	public function reset_password($token = null, $user = null) {
		if (empty($token)) {
			$admin = false;
			if ($user) {
				$this->request->data = $user;
				$admin = true;
			}
			$this->_sendPasswordReset($admin);
		} else {
			$this->_resetPassword($token);
		}
	}
	

}

?>