<?php
/**
 * Utopia PHP Framework
 *
 * @package Framework
 * @subpackage Core
 * 
 * @link http://code.google.com/p/utopia-php-framework/
 * @author Eldad Fux <eldad@fuxie.co.il>
 * @version 1.0 RC2
 * @license The MIT License (MIT) <http://www.opensource.org/licenses/mit-license.php>
 */

namespace Utopia;

class Response {
	
	const _CONTENT_TYPE_TEXT 		= 'Content-Type: text/html; charset=UTF-8';
	const _CONTENT_TYPE_JSON 		= 'Content-Type: application/json; charset=UTF-8';
	const _CONTENT_TYPE_XML	 		= 'Content-Type: text/xml; charset=UTF-8';
	const _CONTENT_TYPE_JAVASCRIPT	= 'Content-Type: text/javascript; charset=UTF-8';
	
	/**
	 * @var string
	 */
	private $contentType = self::_CONTENT_TYPE_TEXT;
	
	/**
	 * @var array
	 */
	private $headers = array();
	
	/**
	 * @var array
	 */
	private $cookies = array();
	
	/**
	 * @param string $type
	 */
	public function setContentType($type) {
		$this->contentType = $type;
	}
	
	/**
	 * @param string $value
	 * @param bool $exit [optional]
	 */
	public function addHeader($value, $exit = false){
		$this->headers[] = array('value' => $value, 'exit' => $exit);
		return $this;
	}
	
	/**
	 * @param string $name
	 * @param string $value 	[optional]
	 * @param int $expire 		[optional]
	 * @param string $path 		[optional]
	 * @param string $domain 	[optional]
	 * @param bool $secure 		[optional]
	 * @param bool $httponly 	[optional]
	 */
	public function addCookie($name, $value = null, $expire = null, $path = null, $domain = null, $secure = null, $httponly = null) {
		$this->cookies[] = array(
			'name'		=> $name,
			'value'		=> $value,
			'expire'	=> $expire,
			'path' 		=> $path,
			'domain' 	=> $domain,
			'secure' 	=> $secure,
			'httponly'	=> $httponly,
		);
		
		return $this;
	}
	
	public function send() {
		$this->appendCookies()->appendHeaders();
	}
	
	/**
	 * @return Response
	 */
	private function appendHeaders() {
		
		header($this->contentType);

		foreach ($this->headers as $header){
			header($header['value']);
			
			if ($header['exit']){
				exit();
			}
		}
		
		return $this;
	}
	
	/**
	 * @return Response
	 */
	private function appendCookies() {
		
		foreach ($this->cookies as $cookie){
			setcookie($cookie['name'], $cookie['value'], $cookie['expire'], $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly']);
		}
		
		return $this;
	}
}