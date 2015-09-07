<?php
namespace Nodes;

/**
 * Encryption and decryption methods
 *
 * Used for communication between the Platform and a backend
 *
 * @see https://developers.facebook.com/docs/authentication/canvas/encryption_proposal/
 * @see https://github.com/ptarjan/crypto-request-examples
 */
class Security {

	public static function encrypt($secret, $data) {
		// wrap data inside payload if we are encrypting
		$cipher = MCRYPT_RIJNDAEL_128;
		$mode	= MCRYPT_MODE_CBC;

		$iv = mcrypt_create_iv(mcrypt_get_iv_size($cipher, $mode), MCRYPT_DEV_URANDOM);
		$data = array(
			'payload' => static::_base64UrlEncode(mcrypt_encrypt($cipher, $secret, json_encode($data), $mode, $iv)),
			'iv'	  => static::_base64UrlEncode($iv)
		);

		// always present, and always at the top level
		$data['algorithm'] = 'AES-256-CBC HMAC-SHA256';
		$data['issued_at'] = time();

		// sign it
		$payload	= static::_base64UrlEncode(json_encode($data));
		$sig		= static::_base64UrlEncode(hash_hmac('sha256', $payload, $secret, true));

		return $sig . '.' . $payload;
	}

	protected static function _base64UrlEncode($input) {
		$str = strtr(base64_encode($input), '+/=', '-_.');
		$str = str_replace('.', '', $str); // remove padding
		return $str;
	}

	public static function decrypt($secret, $input, $maxAge = 3600) {
		if (!strpos($input, '.')) {
			throw new Exception('Invalid request. (Invalid format)');
		}
		list($encodedSig, $encodedEnvelope) = explode('.', $input, 2);
		$envelope	= json_decode(static::_base64UrlDecode($encodedEnvelope), true);
		$algorithm	= $envelope['algorithm'];

		if ($algorithm != 'AES-256-CBC HMAC-SHA256' && $algorithm != 'HMAC-SHA256') {
			throw new Exception('Invalid request. (Unsupported algorithm.)');
		}

		if ($envelope['issued_at'] < time() - $maxAge) {
			throw new Exception('Invalid request. (Too old.)');
		}

		if (static::_base64UrlDecode($encodedSig) != hash_hmac('sha256', $encodedEnvelope, $secret,  true)) {
			throw new Exception('Invalid request. (Invalid signature.)');
		}

		// otherwise, decrypt the payload
		return json_decode(trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $secret, static::_base64UrlDecode($envelope['payload']), MCRYPT_MODE_CBC, static::_base64UrlDecode($envelope['iv']))), true);
	}

	protected static function _base64UrlDecode($input) {
		return base64_decode(strtr($input, '-_', '+/'));
	}
}
