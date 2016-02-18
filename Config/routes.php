<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
 
	
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'home'));
	Router::connect('/admin', array('controller' => 'pages', 'action' => 'admin'));
	Router::connect('/admin/users/login', array('controller' => 'pages', 'action' => 'admin'));

	
	/*
	Router::connect('/admin/users/login', array('plugin'=>'authake', 'controller' => 'user', 'action' => 'login'));
	Router::connect('/register', array('plugin'=>'authake', 'controller' => 'user', 'action' => 'register'));
	//Router::connect('/login', array('plugin'=>'authake', 'controller' => 'user', 'action' => 'login'));
	Router::connect('/logout', array('plugin'=>'authake', 'controller' => 'user', 'action' => 'logout'));
	Router::connect('/lost-password', array('plugin'=>'authake', 'controller' => 'user', 'action' => 'lost_password'));
	Router::connect('/verify/*', array('plugin'=>'authake', 'controller' => 'user', 'action' => 'verify'));
	Router::connect('/pass/*', array('plugin'=>'authake', 'controller' => 'user', 'action' => 'pass'));
	Router::connect('/profile', array('plugin'=>'authake', 'controller' => 'user', 'action' => 'index'));
	Router::connect('/denied', array('plugin'=>'authake', 'controller'=>'user', 'action'=>'denied'));	
	*/
	
	//User related (actions)
	Router::connect('/inloggen', array('plugin'=>'users','controller' => 'users', 'action' => 'login'));	
	Router::connect('/inloggen', array('plugin'=>'Users','controller' => 'users', 'action' => 'login'));
	Router::connect('/uitloggen', array('plugin'=>'users','controller' => 'users', 'action' => 'logout'));	
	Router::connect('/uitloggen', array('plugin'=>'Users','controller' => 'users', 'action' => 'logout'));	

	Router::connect('/wachtwoord/vergeten', array('plugin'=>'users','controller' => 'users', 'action' => 'reset_password'));
	Router::connect('/wachtwoord/vergeten/*', array('plugin'=>'Users','controller' => 'users', 'action' => 'reset_password'));		
	Router::connect('/wachtwoord/vergeten', array('plugin'=>'users','controller' => 'users', 'action' => 'reset_password'));
	Router::connect('/wachtwoord/vergeten/*', array('plugin'=>'Users','controller' => 'users', 'action' => 'reset_password'));		

	Router::connect('/wachtwoord/wijzigen', array('plugin'=>'users','controller' => 'users', 'action' => 'change_password'));		
	Router::connect('/wachtwoord/wijzigen', array('plugin'=>'Users','controller' => 'users', 'action' => 'change_password'));			
	
	Router::connect('/registeren', array('plugin'=>'users','controller' => 'users', 'action' => 'add'));		
	Router::connect('/registeren', array('plugin'=>'Users','controller' => 'users', 'action' => 'add'));		
	
	Router::connect('/registeren/bevestig', array('plugin'=>'users','controller' => 'users', 'action' => 'verify'));		
	Router::connect('/registeren/bevestig/*', array('plugin'=>'Users','controller' => 'users', 'action' => 'verify'));		
	Router::connect('/registeren/bevestig', array('plugin'=>'users','controller' => 'users', 'action' => 'verify'));		
	Router::connect('/registeren/bevestig/*', array('plugin'=>'Users','controller' => 'users', 'action' => 'verify'));
	
	Router::connect('/profiel/*', array('plugin'=>'users','controller'=>'users','action'=>'view'));
    
    Router::connect('/applogin', array('plugin'=>'users','controller' => 'users', 'action' => 'applogin'));
	Router::connect('/app_conversion', array('controller' => 'ProductConversionServices', 'action' => 'app_conversion'));
	Router::connect('/softwares/app_conversion', array('controller' => 'ProductConversionServices', 'action' => 'app_conversion'));	
	Router::connect('/softwares/app_conversion_product', array('controller' => 'ProductConversionServices', 'action' => 'app_conversion_product'));
	Router::connect('/softwares/save_extra_offset', array('controller' => 'ProductConversionServices', 'action' => 'save_extra_offset'));

	Router::connect('/softwares/get_extra_offset/*', array('controller' => 'ProductConversionServices', 'action' => 'get_extra_offset'));



/**
 * ...and connect the rest of 'Pages' controller's urls.
 */

Router::mapResources('sites');
Router::parseExtensions();

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
