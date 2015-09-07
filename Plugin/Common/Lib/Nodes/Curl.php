<?php
namespace Nodes;

use \App;
use \Hash;

App::uses('Hash', 'Utility');

/**
 * cURL class helper
 *
 * Please make sure to always use CURLOPT_* constants and not the string versions
 * The class will throw exceptions on errors, so remember to catch them
 *
 * @platform
 * @package Core.Lib
 * @copyright Nodes ApS 2010-2012 <tech@nodes.dk>
 */
class Curl {
/**
 * The cURL resource created by curl_init
 *
 * @var resource
 */
	protected $_curlResource;

/**
 * The default cURL options
 *
 * @var array
 */
	protected $_defaultCurlOptions = array(
		CURLOPT_CUSTOMREQUEST	=> 'GET',
		CURLOPT_RETURNTRANSFER	=> true, // Always return the HTTP body
		CURLOPT_CONNECTTIMEOUT	=> 2,	 // If we can't connect for 2 seconds, abort
		CURLOPT_TIMEOUT			=> 10,	 // Our request should be able to complete within 10 seconds
		CURLOPT_FOLLOWLOCATION	=> true, // TRUE to follow any "Location: " header that the server sends as part of the HTTP header
		CURLOPT_MAXREDIRS		=> 10,	 // The maximum amount of HTTP redirections to follow.
		CURLOPT_IPRESOLVE		=> CURL_IPRESOLVE_V4, // We want IPv4
		CURLOPT_FORBID_REUSE	=> false, // Allow re-use by default
		CURLOPT_FRESH_CONNECT	=> false, // Use the cached connections
		CURLOPT_MAXCONNECTS		=> 5,     // Max number of persistent connections
	);

/**
 * The current curl options
 *
 * @var array
 */
	protected $_curlOptions = array();

/**
 * The current object options
 *
 * @var array
 */
	protected $_options = array();

/**
 * The response body from an executed HTTP request
 *
 * @var string
 */
	protected $_responseBody;

/**
 * Array with response headers with all header keys lowered
 *
 * @var array
 */
	protected $_responseHeadersArray = array();

/**
 * Array with response headers (Raw)
 *
 * @var array
 */
	protected $_responseHeadersArrayRaw = array();

/**
 * The last cURL error
 *
 * @var string
 */
	protected $_curlError;

/**
 * Constructor
 *
 * @param string $url		 The URL to query
 * @param array $curlOptions cURL options
 * @param array $options 	 Object options
 */
	public function __construct($url = null, $curlOptions = array(), $options = array()) {
		$this->_curlOptions = $curlOptions + $this->_defaultCurlOptions;

		if (!empty($url)) {
			$this->_curlOptions = array(CURLOPT_URL => $url) + $this->_curlOptions;
		}

		$this->_options = $options + array('reuseCurlConnection' => true);
	}

/**
 * Execute a HTTP GET request
 *
 * @return mixed
 */
	public function get($data = null) {
		if (!empty($data)) {
			$this->_curlOptions = array(CURLOPT_POSTFIELDS => $data) + $this->_curlOptions;
		}

		$this->_curlOptions = array(CURLOPT_CUSTOMREQUEST => 'GET') + $this->_curlOptions;

		return $this->exec();
	}

/**
 * Execute a HTTP POST request
 *
 * @param array $data POST data
 * @return mixed
 */
	public function post($data = array()) {
		if (!empty($data)) {
			$this->_curlOptions = array(CURLOPT_POSTFIELDS => $data) + $this->_curlOptions;
		}

		$this->_curlOptions = array(CURLOPT_CUSTOMREQUEST => 'POST') + $this->_curlOptions;
		return $this->exec($this->_curlOptions);
	}

/**
 * Execute a HTTP PUT request
 *
 * @param array $data POST data
 * @return mixed
 */
	public function put($data = array()) {
		if (!empty($data)) {
			$this->_curlOptions = array(CURLOPT_POSTFIELDS => $data) + $this->_curlOptions;
		}

		$this->_curlOptions = array(CURLOPT_CUSTOMREQUEST => 'PUT') + $this->_curlOptions;
		return $this->exec($this->_curlOptions);
	}

/**
 * Execute a HTTP DELETE request
 *
 * @return mixed
 */
	public function delete($data = null) {
		if (!empty($data)) {
			$this->_curlOptions = array(CURLOPT_POSTFIELDS => $data) + $this->_curlOptions;
		}

		$this->_curlOptions = array(CURLOPT_CUSTOMREQUEST => 'DELETE') + $this->_curlOptions;
		return $this->exec();
	}

/**
 * Create a cURL resource based on some options
 *
 * @param array $options
 * @return Curl
 */
	public function createCurlResource($options = array()) {
		$this->cleanup();

		if (empty($this->_curlResource)) {
			$this->_curlResource = curl_init();
			$this->_curlOptions = array(CURLOPT_HEADERFUNCTION => array($this, 'curlHeaderCallback')) + $this->_curlOptions;
		}

		// Multidimensional arrays need to be converted to a query string as there is no built-in support for it
		// This unfortunately makes it impossible to post files in a multidimensional array without extra work
		if (!empty($this->_curlOptions[CURLOPT_POSTFIELDS]) && is_array($this->_curlOptions[CURLOPT_POSTFIELDS])) {
			foreach ($this->_curlOptions[CURLOPT_POSTFIELDS] as $f => $v) {
				if (is_array($v)) {
					$this->_curlOptions[CURLOPT_POSTFIELDS] = http_build_query($this->_curlOptions[CURLOPT_POSTFIELDS]);
					break;
				}
			}
		}

		curl_setopt_array($this->_curlResource, $this->_curlOptions);
		return $this;
	}

/**
 * Replace the current stored cURL resource with a new one
 *
 * @param resource $object
 * @return void
 */
	public function setCurlResource($object) {
		$this->_curlResource = $object;
		$this->checkError();
	}

/**
 * Get the current cURL resource
 *
 * @return resource
 */
	public function getCurlResource() {
		return $this->_curlResource;
	}

/**
 * Execute a cURL request
 *
 * Throws an CurlException on any cURL errors
 *
 * @throws Curl\Exception
 * @param array $options
 * @return Curl
 */
	public function exec($options = array()) {
		$this->createCurlResource($options);
		$this->_responseBody = curl_exec($this->_curlResource);
		$this->checkError();
		return $this;
	}

/**
 * Manually overwrite the response body
 *
 * @param mixed $body
 * @return Curl
 */
	public function setResponseBody($body) {
		$this->_responseBody = $body;
		return $this;
	}

/**
 * Reset the curlResource object
 *
 * @return Curl
 */
	public function cleanup() {
		$this->_responseBody = null;
		$this->_responseHeadersArray = array();
		$this->_responseHeadersArrayRaw = array();

		if ($this->_options['reuseCurlConnection'] || empty($this->_curlResource)) {
			return $this;
		}

		curl_close($this->_curlResource);
		$this->_curlResource = null;
		unset($this->_curlResource);

		return $this;
	}

/**
 * Parse headers from the current cURL request
 *
 * @param object $resURL
 * @param string $strHeader	The raw HTTP header
 * @return integer
 */
	public function curlHeaderCallback($resURL, $header) {
		if (false !== strstr($header, ':')) {
			list($key, $value) = explode(':', $header);

			$this->_responseHeadersArray[strtolower($key)] = trim($value);
			$this->_responseHeadersArrayRaw[$key] = trim($value);
		}

		return strlen($header);
	}

/**
 * Get the response content type
 *
 * @return string
 */
	public function getResponseType() {
		return curl_getinfo($this->_curlResource, CURLINFO_CONTENT_TYPE);
	}

/**
 * Get the response code
 *
 * @return integer
 */
	public function getResponseCode() {
		return curl_getinfo($this->_curlResource, CURLINFO_HTTP_CODE);
	}

/**
 * Get a specific response header by key
 *
 * @param string $key 	The HTTP header name
 * @param boolean $raw 	Should we check the raw response (key has to match in case)
 * @return mixed
 */
	public function getResponseHeader($key, $raw = false) {
		$headers = $this->getResponseHeaders($raw);

		$value = null;
		if (array_key_exists($key, $headers)) {
			$value = $headers[$key];
		}

		return $value;
	}

/**
 * Get the array with all HTTP response headers
 *
 * @param boolean $raw Should we return the raw response (key has not been normalized)
 * @return array
 */
	public function getResponseHeaders($raw = false) {
		if ($raw) {
			$this->_responseHeadersArrayRaw;
		}
		return $this->_responseHeadersArray;
	}

/**
 * Get the HTTP response body from the server
 *
 * Will try to decode data based on response content type unless raw is true
 *
 * @param boolean $raw	Return the RAW response body
 * @return mixed
 */
	public function getResponseBody($raw = false) {
		if ($raw) {
			return $this->_responseBody;
		}

		$type = $this->getResponseType();

		// Handle responses like: text/javascript; charset=UTF-8
		if (false !== strpos($type, ';')) {
			list($type, $encoding) = explode(';', $type);
		}

		switch($type) {
			case 'text/json':
			case 'text/javascript':
			case 'application/json':
			case 'json':
				return json_decode($this->_responseBody, true);
			default:
				return $this->_responseBody;
		}
	}

/**
 * Utility method to check if the current curlResource has error
 *
 * Will throw an error if there is any errors
 *
 * @return Curl
 */
	public function checkError() {
		if ($this->hasError()) {
			throw new Curl\Exception($this->getError());
		}

		return $this;
	}

/**
 * Check if the cURL object has any errors
 *
 * @return boolean
 */
	public function hasError() {
		return '' !== $this->getError();
	}

/**
 * Get the last cURL error
 *
 * @return string
 */
	public function getError() {
		return curl_error($this->_curlResource);
	}

/**
 * Set option for the cURL resource
 *
 * If key is an array, its expected to be a key => value pair and will be merged with _curlOptions
 *
 * @param string|array	$key
 * @param string			$value
 * @return Curl
 */
	public function setOption($key, $value = null) {
		if (is_array($key)) {
			$this->_curlOptions = $this->_curlOptions + $key;
			return;
		}
		$this->_curlOptions[$key] = $value;
		return $this;
	}

	public function __clone() {
		$instance = new $this(null, $this->_curlOptions, $this->_options);
		return $instance;
	}
}
