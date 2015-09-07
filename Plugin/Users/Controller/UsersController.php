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

App::uses('UsersAppController', 'Users.Controller');

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
class UsersController extends UsersAppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Users';

/**
 * If the controller is a plugin controller set the plugin name
 *
 * @var mixed
 */
	public $plugin = null;

/**
 * Helpers
 *
 * @var array
 */
    public $helpers = array(
        'Session',
		'Js' => array('Jquery'),
        'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
        'Form' => array('className' => 'BoostCake.BoostCakeForm'),
        'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
		'Time',
		'Text'
    );		

/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Auth',
		'Session',
		'Cookie',
		'Paginator',
		'Security',
		'Search.Prg',
		'Users.RememberMe',
		'RequestHandler'
	);

/**
 * Preset vars
 *
 * @var array $presetVars
 * @link https://github.com/CakeDC/search
 */
	public $presetVars = array(
		array('field' => 'search', 'type' => 'value'),
		array('field' => 'username', 'type' => 'value'),
		array('field' => 'email', 'type' => 'value'));

/**
 * Constructor
 *
 * @param CakeRequest $request Request object for this controller. Can be null for testing,
 *  but expect that features that use the request parameters will not work.
 * @param CakeResponse $response Response object for this controller.
 */
	public function __construct($request, $response) {
		$this->_setupComponents();
		$this->_setupHelpers();
		parent::__construct($request, $response);
		$this->_reInitControllerName();
	}

/**
 * Providing backward compatibility to a fix that was just made recently to the core
 * for users that want to upgrade the plugin but not the core
 *
 * @link http://cakephp.lighthouseapp.com/projects/42648-cakephp/tickets/3550-inherited-controllers-get-wrong-property-names
 * @return void
 */
	protected function _reInitControllerName() {
		$name = substr(get_class($this), 0, -10);
		if ($this->name === null) {
			$this->name = $name;
		} elseif ($name !== $this->name) {
			$this->name = $name;
		}
	}

/**
 * Returns $this->plugin with a dot, used for plugin loading using the dot notation
 *
 * @return mixed string|null
 */
	protected function _pluginDot() {
		if (is_string($this->plugin)) {
			return $this->plugin . '.';
		}
		return $this->plugin;
	}

/**
 * Setup components based on plugin availability
 *
 * @return void
 * @link https://github.com/CakeDC/search
 */
	protected function _setupComponents() {
		if (App::import('Component', 'Search.Prg')) {
			$this->components[] = 'Search.Prg';
		}
	}

/**
 * Setup helpers based on plugin availability
 *
 * @return void
 */
	protected function _setupHelpers() {
		if (App::import('Helper', 'Goodies.Gravatar')) {
			$this->helpers[] = 'Goodies.Gravatar';
		}
	}

/**
 * beforeFilter callback
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->_setupAuth();
		
		$this->Components->disable('Security');

		$this->set('model', $this->modelClass);

		if (!Configure::read('App.defaultEmail')) {
			Configure::write('App.defaultEmail', 'noreply@' . env('HTTP_HOST'));
		}
		
		// Change layout for Ajax requests
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}		
		
		$this->loadModel('Currency');
		$this->Currency->recursive 				= -1;
		
		$locale = Configure::read('Config.language');		
		if ($locale == 'fra')
		{
			Configure::write('debug', 0);
		}
	}

/**
 * Setup Authentication Component
 *
 * @return void
 */
	protected function _setupAuth() {
		$this->Auth->allow('add', 'reset', 'verify', 'logout', 'view', 'reset_password', 'login', 'cadeaubonnen','download');
		if (!is_null(Configure::read('Users.allowRegistration')) && !Configure::read('Users.allowRegistration')) {
			$this->Auth->deny('add');
		}
		if ($this->request->action == 'register') {
			$this->Components->disable('Auth');
		}

		$this->Auth->authenticate = array(
			'Custom' => array(
				'fields' => array(
		            'username' => array('username', 'email'),
					'password' => 'password'
				),
				'userModel' => $this->_pluginDot() . $this->modelClass,
				'scope' => array(
					$this->modelClass . '.active' => 1,
					$this->modelClass . '.email_verified' => 1)));

		$this->Auth->loginRedirect = array('plugin'=>false, 'controller' => 'pages', 'action' => 'home');
		$this->Auth->logoutRedirect = array('plugin' => $this->plugin, 'controller' => 'users', 'action' => 'login');
		$this->Auth->loginAction = array('admin' => false, 'plugin' => $this->plugin, 'controller' => 'users', 'action' => 'login');
	}


/**
 * Simple listing of all users
 *
 * @return void
 */
	public function index() {
		$this->paginate = array(
			'limit' => 12,
			'conditions' => array(
				$this->modelClass . '.active' => 1,
				$this->modelClass . '.email_verified' => 1));
		$this->set('users', $this->paginate($this->modelClass));
	}

/**
 * The homepage of a users giving him an overview about everything
 *
 * @return void
 */
	public function dashboard() {
		$user = $this->{$this->modelClass}->read(null, $this->Auth->user('id'));
		$this->set('user', $user);
	}

/**
 * Shows a users profile
 *
 * @param string $slug User Slug
 * @return void
 */
	public function view($slug = null) {
		try {
			$this->set('user', $this->{$this->modelClass}->view($slug));
		} catch (Exception $e) {
			$this->Session->setFlash($e->getMessage());
			$this->redirect('/');
		}
	}
/**
 * Edit
 *
 * @param string $id User ID
 * @return void
 */
	public function edit_username() {
		
		if($this->request->is('ajax') || $this->request->is('post'))
		{		
			if (!empty($this->request->data)) {
				$userdata = $this->User->read(null,$this->Auth->user('id'));
				$this->request->data['User']['tos'] = 1;
				$this->request->data['User']['email'] = $userdata['User']['email'];
				if ($this->User->save($this->request->data)) {
					$return_array = array();
					$return_array['data'] = $this->request->data;
					$return_array['message'] = __d('fotoalbum', 'Username saved.');
					if (isset($this->request->data['Msg']['return_text']))
					{
						$return_array['message'] = $this->request->data['Msg']['return_text'];
					}
					$this->set('success', $return_array);
					$this->set('_serialize', array('success'));									
					//$this->Session->setFlash(__d('fotoalbum', 'Username saved.'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-success'));
					$this->Session->write('Auth.User.username',$this->request->data['User']['username']);
				} else {
					$User = $this->User->validationErrors;
					$data = compact('User');
					$this->set('errors', $data);
					$this->set('_serialize', array('errors'));				
					//$this->Session->setFlash(__d('fotoalbum', 'Could not save your username.'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-error'));
				}
			} else {
				$this->Session->setFlash(__d('fotoalbum', 'An Ajax error occured, please try again or refresh'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-error'));
			}
		}
	}
/**
 * Edit
 *
 * @param string $id User ID
 * @return void
 */
	public function edit() {
		if (!empty($this->request->data)) {
			if (!isset($this->request->data['UserDetail']['country']))
			{
				$this->request->data['UserDetail']['country'] = 'NL';
			}		
			if ($this->request->data['UserDetail']['country'] == 'AF')
			{
				$this->request->data['UserDetail']['country'] = 'NL';
			}
			if (!isset($this->request->data['UserDetail']['language']))
			{
				$this->request->data['UserDetail']['language'] = 'nld';
			}			
			if ($this->{$this->modelClass}->UserDetail->saveSection($this->Auth->user('id'), $this->request->data, 'User')) {
				$this->Session->setFlash(__d('fotoalbum', 'Profile saved.'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-success'));
				if($this->request->is('ajax'))
				{
					if (isset($this->request->data['User']['username']))
					{
						$this->Session->write('Auth.User.username',$this->request->data['User']['username']);
					}
					echo $this->render('/Elements/form_result');
					die();
				}
				$this->redirect(array('action' => 'dashboard'));
			} else {
				$this->Session->setFlash(__d('fotoalbum', 'Could not save your profile.'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-error'));
				if($this->request->is('ajax'))
				{
					echo $this->render('/Elements/form_result');
					die();
				}				
			}
		} else {
			$data = $this->{$this->modelClass}->UserDetail->getSection($this->Auth->user('id'), 'User');
			$this->{$this->modelClass}->recursive = -1;
			$user = $this->{$this->modelClass}->read(null,$this->Auth->user('id'));
			$this->request->data = $user;
			if (!isset($data[$this->modelClass])) {
				$data[$this->modelClass] = array();
			}
			$this->request->data['UserDetail'] = $data[$this->modelClass];
			if (!isset($this->request->data['UserDetail']['country']))
			{
				$this->request->data['UserDetail']['country'] = 'NL';
			}		
			if ($this->request->data['UserDetail']['country'] == 'AF')
			{
				$this->request->data['UserDetail']['country'] = 'NL';
			}
			if (!isset($this->request->data['UserDetail']['language']))
			{
				$this->request->data['UserDetail']['language'] = 'nld';
			}

			App::import('Lib', 'Utils.Languages');
			$Languages = new Languages();
			$languageList = $Languages->lists('locale');			
			App::import('Lib', 'Utils.I18nCountry');
			$I18nCountry = new I18nCountry();
			$countryList = $I18nCountry->getList('locale');		
			$this->set(compact('user','languageList','countryList'));
		}
	}

/**
 * Admin Index
 *
 * @return void
 */
	public function admin_index() {
		$this->Prg->commonProcess();
		unset($this->{$this->modelClass}->validate['username']);
		unset($this->{$this->modelClass}->validate['email']);
		$this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;
		if ($this->{$this->modelClass}->Behaviors->attached('Searchable')) {
			$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		} else {
			$parsedConditions = array();
		}
		$this->Paginator->settings[$this->modelClass]['conditions'] = $parsedConditions;
		$this->Paginator->settings[$this->modelClass]['order'] = array($this->modelClass . '.created' => 'desc');

		$this->{$this->modelClass}->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * Admin view
 *
 * @param string $id User ID
 * @return void
 */
	public function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('fotoalbum', 'Invalid User.'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-error'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->{$this->modelClass}->read(null, $id));
	}

/**
 * Admin add
 *
 * @return void
 */
	public function admin_add() {
		if (!empty($this->request->data)) {
			$this->request->data[$this->modelClass]['tos'] = true;
			$this->request->data[$this->modelClass]['email_verified'] = true;

			if ($this->{$this->modelClass}->add($this->request->data)) {
				$this->Session->setFlash(__d('fotoalbum', 'The User has been saved'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-success'));
				$this->redirect(array('action' => 'index'));
			}
		}
		$this->set('roles', Configure::read('Users.roles'));
	}

/**
 * Admin edit
 *
 * @param string $id User ID
 * @return void
 */
	public function admin_edit($userId = null) {
		try {
			$result = $this->{$this->modelClass}->edit($userId, $this->request->data);
			if ($result === true) {
				$this->Session->setFlash(__d('fotoalbum', 'User saved'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->request->data = $result;
			}
		} catch (OutOfBoundsException $e) {
			$this->Session->setFlash($e->getMessage(), 'alert', array('plugin' => 'BoostCake','class' => 'alert-error'));
			$this->redirect(array('action' => 'index'));
		}

		if (empty($this->request->data)) {
			$this->request->data = $this->{$this->modelClass}->read(null, $userId);
		}
		$this->set('roles', Configure::read('Users.roles'));
	}

/**
 * Delete a user account
 *
 * @param string $userId User ID
 * @return void
 */
	public function admin_delete($userId = null) {
		if ($this->{$this->modelClass}->delete($userId)) {
			$this->Session->setFlash(__d('fotoalbum', 'User deleted'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-success'));
		} else {
			$this->Session->setFlash(__d('fotoalbum', 'Invalid User'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-error'));
		}

		$this->redirect(array('action' => 'index'));
	}

/**
 * Search for a user
 *
 * @return void
 */
	public function admin_search() {
		$this->search();
	}

/**
 * User register action
 *
 * @return void
 */
	public function add() {
		if ($this->Auth->user()) {
			$this->Session->setFlash(__d('fotoalbum', 'You are already registered and logged in!'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-success'));
			$this->redirect('/');
		}

		if (!empty($this->request->data)) {
			$user = $this->{$this->modelClass}->register($this->request->data);
			if ($user !== false) {
				$this->_sendVerificationEmail($this->{$this->modelClass}->data);
				$this->Session->setFlash(__d('fotoalbum', 'Your account has been created. You should receive an e-mail shortly to authenticate your account. Once validated you will be able to login.'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-warning'));
				$this->redirect(array('action' => 'login'));
			} else {
				unset($this->request->data[$this->modelClass]['password']);
				unset($this->request->data[$this->modelClass]['temppassword']);
				$this->Session->setFlash(__d('fotoalbum', 'Your account could not be created. Please, try again.'), 'default', array('class' => 'message warning'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-error'));
			}
		}
	}

/**
 * Common login action
 *
 * @return void
 */
	public function login() {
		if ($this->request->is('post')) {
			
			if ($this->Auth->login()) {
				
				$this->getEventManager()->dispatch(new CakeEvent('Users.afterLogin', $this, array(
					'isFirstLogin' => !$this->Auth->user('last_login'))));

				$this->{$this->modelClass}->id = $this->Auth->user('id');
				$this->{$this->modelClass}->saveField('last_login', date('Y-m-d H:i:s'));

				/*
				if ($this->here == $this->Auth->loginRedirect) {
					$this->Auth->loginRedirect = array('plugin'=>false, 'controller' => 'orders', 'action' => 'library');					
				}
				*/
				//$this->Session->setFlash(sprintf(__d('fotoalbum', '%s you have successfully logged in'), $this->Auth->user('username')), 'alert', array('plugin' => 'BoostCake','class' => 'alert-success'));
				if (!empty($this->request->data)) {
					$data = $this->request->data[$this->modelClass];
					if (empty($this->request->data[$this->modelClass]['remember_me'])) {
						$this->RememberMe->destroyCookie();
					} else {
						$this->_setCookie();
					}
				}
										
				if (empty($data['return_to'])) {
					$data['return_to'] = null;
				}
				
				if (!empty($data['redirect'])) {
					$data['return_to'] = $data['redirect'];
				}


				$this->redirect($this->Auth->redirect($data['return_to']));
			} else {
				$this->Auth->flash(__d('fotoalbum', 'Invalid e-mail / password combination.  Please try again'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-error'));
			}
		}
		else
		{
			$user_id = $this->Auth->user('id');
			if (isset($user_id))
			{
				$this->redirect(array('action' => 'dashboard'));
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
 * Search - Requires the CakeDC Search plugin to work
 *
 * @throws MissingPluginException
 * @return void
 * @link https://github.com/CakeDC/search
 */
	public function search() {
		if (!App::import('Component', 'Search.Prg')) {
			throw new MissingPluginException(array('plugin' => 'Search'));
		}

		$searchTerm = '';
		$this->Prg->commonProcess($this->modelClass, $this->modelClass, 'search', false);

		$by = null;
		if (!empty($this->request->params['named']['search'])) {
			$searchTerm = $this->request->params['named']['search'];
			$by = 'any';
		}
		if (!empty($this->request->params['named']['username'])) {
			$searchTerm = $this->request->params['named']['username'];
			$by = 'username';
		}
		if (!empty($this->request->params['named']['email'])) {
			$searchTerm = $this->request->params['named']['email'];
			$by = 'email';
		}
		$this->request->data[$this->modelClass]['search'] = $searchTerm;

		$this->paginate = array(
			'search',
			'limit' => 12,
			'by' => $by,
			'search' => $searchTerm,
			'conditions' => array(
					'AND' => array(
						$this->modelClass . '.active' => 1,
						$this->modelClass . '.email_verified' => 1)));

		$this->set('users', $this->paginate($this->modelClass));
		$this->set('searchTerm', $searchTerm);
	}

/**
 * Common logout action
 *
 * @return void
 */
	public function logout() {
		$this->Session->destroy();
		//$this->Cookie->destroy();
		//$this->RememberMe->destroyCookie();
		$this->Session->setFlash(sprintf(__d('fotoalbum', 'You have successfully logged out')), 'alert', array('plugin' => 'BoostCake','class' => 'alert-success'));
		$this->redirect($this->Auth->logout());
	}

/**
 * Confirm email action
 *
 * @param string $type Type, deprecated, will be removed. Its just still there for a smooth transistion.
 * @param string $token Token
 * @return void
 */
	public function verify($type = 'email', $token = null) {
		if ($type == 'reset') {
			// Backward compatiblity
			$this->request_new_password($token);
		}

		try {
			$this->{$this->modelClass}->verifyEmail($token);
			$this->Session->setFlash(__d('fotoalbum', 'Your e-mail has been validated!'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-success'));
			return $this->redirect(array('action' => 'login'));
		} catch (RuntimeException $e) {
			$this->Session->setFlash($e->getMessage(), 'alert', array('plugin' => 'BoostCake','class' => 'alert-error'));
			return $this->redirect('/');
		}
	}

/**
 * This method will send a new password to the user
 *
 * @param string $token Token
 * @throws NotFoundException
 * @return void
 */
	public function request_new_password($token = null) {
		if (Configure::read('Users.sendPassword') !== true) {
			throw new NotFoundException();
		}

		$data = $this->{$this->modelClass}->validateToken($token, true);

		if (!$data) {
			$this->Session->setFlash(__d('fotoalbum', 'The url you accessed is not longer valid'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-error'));
			return $this->redirect('/');
		}

		$email = $data[$this->modelClass]['email'];
		unset($data[$this->modelClass]['email']);

		if ($this->{$this->modelClass}->save($data, array('validate' => false))) {
			$this->_sendNewPassword($data);
			$this->Session->setFlash(__d('fotoalbum', 'Your password was sent to your registered email account'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-success'));
			return $this->redirect(array('action' => 'login'));
		}

		$this->Session->setFlash(__d('fotoalbum', 'There was an error verifying your account. Please check the email you were sent, and retry the verification link.'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-warning'));
		$this->redirect('/');
	}

/**
 * Sends the password reset email
 *
 * @param array
 * @return void
 */
	protected function _sendNewPassword($userData, $options = array()) {
		
		$defaults = array(
			'from' => Configure::read('App.defaultEmail'),
			'subject' => __d('fotoalbum', 'Password Reset'),
			'template' => $this->_pluginDot() . 'password_reset_request',
			'layout' => 'default');

		$options = array_merge($defaults, $options);
		$locale = Configure::read('Config.language');
		if ($locale)
		{
			if (file_exists(APP . DS . 'View' . DS . $locale . DS . 'Emails' . DS . 'html' . DS . str_replace($this->_pluginDot(),'',$options['template']).'.ctp')) {
				$options['template'] = DS. $locale . DS . 'Emails' . DS . 'html' . DS . str_replace($this->_pluginDot(),'',$options['template']);
			}
			if (file_exists(APP . DS . 'View' . DS. 'Layouts' . DS . 'Emails' . DS . 'html' . DS . $options['layout'].'_'.$locale.'.ctp')) {
				$options['layout'] = $options['layout'].'_'.$locale;
			}				
		}		

		$Email = $this->_getMailInstance();
		$Email->from(Configure::read('App.defaultEmail'))
			->to($userData[$this->modelClass]['email'])
			->emailFormat('html')
			->replyTo(Configure::read('App.defaultEmail'))
			->return(Configure::read('App.defaultEmail'))
			->subject(env('HTTP_HOST') . ' ' . __d('fotoalbum', 'Password Reset'))
			->template($this->_pluginDot() . 'new_password', $options['layout'])
			->viewVars(array(
				'model' => $this->modelClass,
				'userData' => $userData))
			->send();
	}

/**
 * Allows the user to enter a new password, it needs to be confirmed by entering the old password
 *
 * @return void
 */
	public function change_password() {
		if ($this->request->is('post')) {
			$this->request->data[$this->modelClass]['id'] = $this->Auth->user('id');
			if ($this->{$this->modelClass}->changePassword($this->request->data)) {
				$this->Session->setFlash(__d('fotoalbum', 'Password changed.'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-success'));
				// we don't want to keep the cookie with the old password around
				$this->RememberMe->destroyCookie();
				$this->redirect('/');
			}
		}
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


    public function login_as_user($id = null) {
		if ($this->Ability->check('manage','all'))
		{	
			$new_user_data = $this->User->read(null,$id);
			$this->User->id = $id;
			$this->request->data['User'] = $new_user_data['User'];
			$this->Auth->logout();
			if ($this->Auth->login($this->request->data['User']))
			{
		        $this->redirect(array('plugin' => null, 'controller' => 'orders', 'action' => 'library'));
			}
			else
			{
		        $this->redirect(array('plugin' => 'users', 'controller' => 'users', 'action' => 'login'));
			}
		}
		else
		{
			$this->redirect(array('plugin' => null, 'controller' => 'pages', 'action' => 'access_denied'));
		}
    }

/**
 * Sets a list of languages to the view which can be used in selects
 *
 * @deprecated No fallback provided, use the Utils plugin in your app directly
 * @param string $viewVar View variable name, default is languages
 * @throws MissingPluginException
 * @return void
 * @link https://github.com/CakeDC/utils
 */
	protected function _setLanguages($viewVar = 'languages') {
		if (!App::import('Lib', 'Utils.Languages')) {
			throw new MissingPluginException(array('plugin' => 'Utils'));
		}
		$Languages = new Languages();
		$this->set($viewVar, $Languages->lists('locale'));
	}

/**
 * Sends the verification email
 *
 * This method is protected and not private so that classes that inherit this
 * controller can override this method to change the varification mail sending
 * in any possible way.
 *
 * @param string $to Receiver email address
 * @param array $options EmailComponent options
 * @return boolean Success
 */
	protected function _sendVerificationEmail($userData, $options = array()) {
		$defaults = array(
			'from' => Configure::read('App.defaultEmail'),
			'subject' => __d('fotoalbum', 'Account verification'),
			'template' => $this->_pluginDot() . 'account_verification',
			'layout' => 'default');

		$options = array_merge($defaults, $options);
		$locale = Configure::read('Config.language');
		if ($locale)
		{
			if (file_exists(APP . DS . 'View' . DS . $locale . DS . 'Emails' . DS . 'html' . DS . str_replace($this->_pluginDot(),'',$options['template']).'.ctp')) {
				$options['template'] = DS. $locale . DS . 'Emails' . DS . 'html' . DS . str_replace($this->_pluginDot(),'',$options['template']);
			}
			if (file_exists(APP . DS . 'View' . DS. 'Layouts' . DS . 'Emails' . DS . 'html' . DS . $options['layout'].'_'.$locale.'.ctp')) {
				$options['layout'] = $options['layout'].'_'.$locale;
			}				
		}	
				debug($options);			


		$Email = $this->_getMailInstance();
		$Email->to($userData[$this->modelClass]['email'])
			->emailFormat('html')
			->from($options['from'])
			->subject($options['subject'])
			->template($options['template'], $options['layout'])
			->viewVars(array(
			'model' => $this->modelClass,
				'user' => $userData))
			->send();
	}

/**
 * Checks if the email is in the system and authenticated, if yes create the token
 * save it and send the user an email
 *
 * @param boolean $admin Admin boolean
 * @param array $options Options
 * @return void
 */
	protected function _sendPasswordReset($admin = null, $options = array()) {
		
		$user_id = $this->Auth->user('id');
		if ( (isset($user_id)) && ($user_id>0) )
		{
			$this->redirect(array('plugin' => 'users', 'controller' => 'users', 'action' => 'dashboard'));
		}
		
		$defaults = array(
			'from' => Configure::read('App.defaultEmail'),
			'subject' => __d('fotoalbum', 'Password Reset'),
			'template' => $this->_pluginDot() . 'password_reset_request',
			'layout' => 'default');

		$options = array_merge($defaults, $options);
		$locale = Configure::read('Config.language');
		if ($locale)
		{
			if (file_exists(APP . DS . 'View' . DS . $locale . DS . 'Emails' . DS . 'html' . DS . str_replace($this->_pluginDot(),'',$options['template']).'.ctp')) {
				$options['template'] = DS. $locale . DS . 'Emails' . DS . 'html' . DS . str_replace($this->_pluginDot(),'',$options['template']);
			}
			if (file_exists(APP . DS . 'View' . DS. 'Layouts' . DS . 'Emails' . DS . 'html' . DS . $options['layout'].'_'.$locale.'.ctp')) {
				$options['layout'] = $options['layout'].'_'.$locale;
			}				
		}
		if (!empty($this->request->data)) {
			$user = $this->{$this->modelClass}->passwordReset($this->request->data);

			if (!empty($user)) {

				$Email = $this->_getMailInstance();
				$Email->to($user[$this->modelClass]['email'])
					->emailFormat('html')
					->from($options['from'])
					->subject($options['subject'])
					->template($options['template'], $options['layout'])
					->viewVars(array(
					'model' => $this->modelClass,
					'show_album' => false,
					'user' => $this->{$this->modelClass}->data,
					'token' => $this->{$this->modelClass}->data[$this->modelClass]['password_token']))
					->send();

				if ($admin) {
					$this->Session->setFlash(sprintf(
						__d('fotoalbum', '%s has been sent an email with instruction to reset their password.'),
						$user[$this->modelClass]['email']), 'alert', array('plugin' => 'BoostCake','class' => 'alert-warning'));
					$this->redirect(array('action' => 'index', 'admin' => true));
				} else {
					$this->Session->setFlash(__d('fotoalbum', 'You should receive an email with further instructions shortly'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-warning'));
					$this->redirect(array('action' => 'login'));
				}
			} else {
				$this->Session->setFlash(__d('fotoalbum', 'No user was found with that email.'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-error'));
				$this->redirect($this->referer('/'));
			}
		}
		$this->render('request_password_change');
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
		$this->RememberMe->setCookie();
	}

/**
 * This method allows the user to change his password if the reset token is correct
 *
 * @param string $token Token
 * @return void
 */
	protected function _resetPassword($token) {
		$user = $this->{$this->modelClass}->checkPasswordToken($token);
		if (empty($user)) {
			$this->Session->setFlash(__d('fotoalbum', 'Invalid password reset token, try again.'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-error'));
			//STEP 3
			$this->redirect(array('action' => 'reset_password'));
		}

		if (!empty($this->request->data) && $this->{$this->modelClass}->resetPassword(Set::merge($user, $this->request->data))) {
			$this->Session->setFlash(__d('fotoalbum', 'Password changed, you can now login with your new password.'), 'alert', array('plugin' => 'BoostCake','class' => 'alert-success'));
			//STEP 2		
			$this->redirect($this->Auth->loginAction);
		}
		
		//STEP 1
		$this->set('token', $token);
	}

/**
 * Returns a CakeEmail object
 *
 * @return object CakeEmail instance
 * @link http://book.cakephp.org/2.0/en/core-utility-libraries/email.html
 */
	protected function _getMailInstance() {
		App::uses('CakeEmail', 'Network/Email');
		$emailConfig = Configure::read('Users.emailConfig');
		if ($emailConfig) {
			return new CakeEmail($emailConfig);
		} else {
			return new CakeEmail('default');
		}
	}

}
