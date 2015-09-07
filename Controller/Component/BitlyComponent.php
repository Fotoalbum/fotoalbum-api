<?php
class BitlyComponent extends Object {
	var $user;
	var $api_key;
 
	function __construct() {
		$this->user = Configure::read('Bitly.login');
		$this->api_key = Configure::read('Bitly.apiKey');	
		$this->BitlyLink = ClassRegistry::init('BitlyLink');
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
		$this->user = Configure::read('Bitly.login');
		$this->api_key = Configure::read('Bitly.apiKey');	
	}
	

	public function beforeRedirect(Controller $Controller) {

	}
	
	public function beforeRender(Controller $Controller) {

	}
	
	public function shutdown()
	{
		
	}

	
	function setApiInfo($user, $api_key) {
		$this->user = $user;
		$this->api_key = $api_key;
	}
 
	function shorten($long_url) {
		
		$cache = $this->BitlyLink->find('first', array('conditions' => array('BitlyLink.long_url' => $long_url)));
 
		if (!empty($cache['BitlyLink']['id'])) {
			return 'http://bit.ly/'.$cache['BitlyLink']['hash'];
		}
 
		$params = array();
		$params['access_token'] = $this->api_key;
		$params['longUrl'] = $long_url;
 
		$url = 'https://api-ssl.bitly.com/v3/shorten?'.http_build_query($params);
 
		$ch = curl_init();
 
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
		$data = curl_exec($ch);
		curl_close($ch);
 
		$data = json_decode($data, true);
 
		if ($data['status_txt'] == 'OK') {
			$save = array('BitlyLink' => array());
			$save['BitlyLink']['long_url'] 	= $data['data']['long_url'];
			$save['BitlyLink']['hash'] 		= $data['data']['hash'];
			$this->BitlyLink->create();
			$this->BitlyLink->save($save);
			return $data['data']['url'];
		} else {
			debug($data);
			return false;
		}
	}
}
?>