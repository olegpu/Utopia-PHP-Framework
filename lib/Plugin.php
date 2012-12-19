<?php
/**
 * Utopia PHP Framework
 *
 * @package Framework
 * @subpackage Core
 * 
 * @link http://code.google.com/p/utopia-php-framework/
 * @author Eldad Fux <eldad@fuxie.co.il>
 * @version 1.0 RC3
 * @license The MIT License (MIT) <http://www.opensource.org/licenses/mit-license.php>
 */

namespace Utopia;

abstract class Plugin {

	/**
	 * @return Application
	 */
	protected function getApp(){
		return Application::getInstance();
	}
	
	/**
	 * @return Layout
	 */
	protected function getLayout() {
		return $this->getApp()->layout;
	}
	
	/**
	 * @return Request
	 */
	protected function getRequest() {
		return $this->getApp()->request;
	}
	
	/**
	 * @return Response
	 */
	protected function getResponse() {
		return $this->getApp()->response;
	}
	
	/**
	 * @return bool
	 */
	protected function isDev() {
		return $this->getApp()->isDev();
	}
}