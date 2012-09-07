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

class Debug extends Plugin {

	private static $html = '<pre style="direction:ltr;text-align:left;white-space:pre;">%s</pre>';
	
	/**
	 * @param mixed
	 */
	public static function log() {
		self::varDumpArgs(func_get_args());
	}
	
	/**
	 * @param mixed
	 */
	public static function logd() {
		self::varDumpArgs(func_get_args());
		exit();
	}
	
	/**
	 * @param array $list
	 */
	private static function varDumpArgs(array $list) {
		ob_start();
		
		foreach ($list as $arg) {
			var_dump($arg);
		}
		
		$buffer = ob_get_clean();
		
		echo sprintf(self::$html, $buffer);
	}
}