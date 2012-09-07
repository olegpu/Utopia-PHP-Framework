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

class Loader {
	
	/**
	 * @var array
	 */
	private $enviorments = array();
	
	function __construct() {
		spl_autoload_register(array($this, 'loader'));		
		
		// FIXME remove this dependencies!!
		$current = basename(realpath('../'));
		
		$this
			->addEnviorment('Utopia', 'framework') // Framework enviorment
			->addEnviorment(ucfirst($current), $current); // Current project enviorment
	}

	/**
	 * @param string $className
	 * @throws \Exception
	 */
	public function loader($className) {
		
		//Get the enviorment key so we could assign it to project path
		$namespace = substr($className, 0, strpos($className, '\\'));
		
		//Build path from namespace
		$search		= array($namespace . '\\', '\\');
		$replace	= array('', '/');
		$className	= str_replace($search, $replace, $className);
		
		if (!array_key_exists($namespace, $this->enviorments)) {
			throw new \Exception('"' . $namespace . '" enviorment doesn\'t exists or not registered');
		}
		
		$path = realpath('../../') . '/' . $this->enviorments[$namespace] . '/lib/' . $className . '.php';
		
		include $path;
	}
	
	/**
	 * @param string $path
	 * @param integer $weight
	 * @return Loader
	 */
	public function addEnviorment($namespace, $path) {
		$this->enviorments[$namespace] = $path;
		return $this;
	}
}