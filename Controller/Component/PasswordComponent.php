<?php
/**
 * Password generator class
 * 
 * @package Albumviewer\Controllers\Components
 */
class PasswordComponent extends Object {
  
  
  
	function __construct() {
	}
 
	public function initialize(Controller $controller) {
		$this->Controller = $controller;
	}

/**
 * Callback
 *
 * @param object Controller
 * @return void
 */
	public function startup(Controller $controller) {
	}
	

	public function beforeRedirect(Controller $Controller) {
	}
	
	public function beforeRender(Controller $Controller) {
	}
	
	public function shutdown() {
	}

    /**
     * Generates a random password
     * 
     * @param $length Lengt of random generated password
     * 
     * @return String Random generated password
     */
    function generatePassword ($length = 8){
        //Set up variables:
        $password = "";
        $possible = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        //Append random characters to password
        while (strlen($password) < $length){
            $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);

            if (!strstr($password, $char)) {
                $password .= $char;
            }
        }
        return $password;
    }
} 
