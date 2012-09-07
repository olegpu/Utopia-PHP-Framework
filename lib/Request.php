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

class Request {

	/**
	 * @var array
	 */
	private $storage = array();

	/**
	 * @return bool
	 */
	public function isPost() {
		return (isset($_POST)) ? true : false;
	}
	
	/**
	 * @param string $key
	 * @param mixed $value
	 */
	public function setStorage($key, $value) {
		$this->storage[$key] = $value;
		return $this;
	}
	
	/**
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function getQuery($key, $default = null) {
		return (isset($_GET[$key])) ? $_GET[$key] : $default;
	}

	/**
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function getPost($key, $default = null) {
		return (isset($_POST[$key])) ? $_POST[$key] : $default;
	}

	/**
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function getRequest($key, $default = null) {
		return (isset($_REQUEST[$key])) ? $_REQUEST[$key] : $default;
	}
	
	/**
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function getServer($key, $default = null) {
		return (isset($_SERVER[$key])) ? $_SERVER[$key] : $default;
	}
	
	/**
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function getCookie($key, $default = null) {
		return (isset($_COOKIE[$key])) ? $_COOKIE[$key] : $default;
	}
	
	/**
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function getStorage($key, $default = null) {
		return (isset($this->storage[$key])) ? $this->storage[$key] : $default;
	}
}