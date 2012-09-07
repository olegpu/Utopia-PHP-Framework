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

abstract class Router extends Plugin {
	
	public function init() {}

	/**
	 * @return string
	 */
	abstract public function getController();
	
	/**
	 * @return string
	 */
	abstract public function getAction();
	
	/**
	 * @return array
	 */
	public function getVars() {}
	
	/**
	 * Returns locale code (string) or false if no locale has been set
	 * 
	 * @return mixed
	 */
	public function getLocale() {
		return false;
	}
}