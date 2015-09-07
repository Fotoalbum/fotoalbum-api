<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {


    var $counter = 0;
	
	public $theme = "Cakestrap";

    public $helpers = array(
		'Form',
		'Time', 
        'Session',
		'Js',
        'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
        'Form' => array('className' => 'BoostCake.BoostCakeForm'),
        'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
		//'Authake.Authake'
    );	
	
	public $components = array(
		'Cookie',
        'Session',
		'Auth' => array(
			'flash' => array(
				'element' => 'alert',
				'key' => 'auth',
				'params' => array(
					'plugin' => 'BoostCake',
					'class' => 'alert-error'
				)
			)
		),
		//'Authake.Authake',
		'RequestHandler',
		'Zip',
		'Users.RememberMe' => array(
			'userModel' => 'SoftwaresUser'
		)
    );

	
    

    public function beforeFilter() {
		
		
		/*
		if ($this->request->is('options') ) {
			$this->response->header('Access-Control-Allow-Origin', "*");
			//$this->response->header('Access-Control-Allow-Credentials', 'true');
			$this->response->header('Access-Control-Allow-Headers', 'Origin, Accept, Authorization, Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control');
			//$this->response->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
			$this->response->header('Access-Control-Allow-Origin','*');
			
			$this->response->send();
			// otherwise it sends things that upset the CORS pre-flight request
			exit();
		}
		*/
		//$this->auth();
		$this->loadModel('Users.User');
		App::uses('ConnectionManager', 'Model');
		$dataSource = ConnectionManager::getDataSource($this->User->useDbConfig);
		$sessionarray 	= $this->Session->read('Auth.User');
		$site_name 		= 'XHIBIT API V2';
		$this->set(compact('sessionarray','site_name'));
		
		if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
            $this->layout = 'admin';
        }

		$user_id = $this->Session->read('Auth.User.id');
		$this->set(compact('user_id'));
		
		$this->Auth->Allow('*');
		
	
		
		
    }	
	
	
	private function auth(){
		Configure::write('Authake.useDefaultLayout', false);
		$this->Authake->beforeFilter($this);
	}
	
	
	public function currentUser(){
		return $this->Session->read('Auth');
	}
	
	
}
