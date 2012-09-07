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

class Layout extends View {

	/**
	 * @var array
	 */
	private $styles = array();
	
	/**
	 * @var array
	 */
	private $scripts = array();
	
	/**
	 * @var array
	 */
	private $meta = array();
	
	/**
	 * @var string
	 */
	private $title = '';
	
	/**
	 * @var string
	 */
	private $inlineScript = '';
	
	public function __construct() {
		$this->addMeta('Utopia Framework v.1', 'generator');
	}
	
	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	
	/**
	 * @param string $path
	 * @return Layout
	 */
	public function addStyle($path) {
		if (!array_key_exists($path, $this->scripts)) {
			$this->styles[$path] = true;
		}
		return $this;
	}
	
	/**
	 * @param string $path
	 * @return Layout
	 */
	public function addScript($path) {
		if (!array_key_exists($path, $this->scripts)) {
			$this->scripts[$path] = true;
		}
		return $this;
	}
	
	/**
	 * @param string $code
	 */
	public function addInlineScript($code) {
		$this->inlineScript .= $code;
		return $this;
	}
		
	/**
	 * @param string $content
	 * @param string $name
	 * @param string $property
	 * @throws \Exception
	 * @return Layout
	 */
	public function addMeta($content, $name = '', $property = '') {
		
		if (empty($name) && empty($property)) {
			throw new \Exception('Meta tag must have at least $name or $property');
		}
		
		$this->meta[$name . '_' . $property] = array(
			'name'		=> $name,
			'property' 	=> $property,
			'content' 	=> $content
		);
		
		return $this;
	}
	
	public function render() {

		if ($this->rendered) { /* Return only content if layout should not be rendered */
			return $this->getParam('content');
		}
		
		/* Set HTML head section */
		$head = $this->setMetas();
		$head .= $this->setStyles();
		$head .= $this->setScripts();
		$head .= ($this->inlineScript) ? '<script>' . $this->inlineScript . '</script>' . "\n" : '';
		$head .= '<title>' . $this->title . '</title>' . "\n";
		
		$this->setParam('head', $head);
		
		return parent::render();
	}

	private function setStyles() {
		$styleTag = '';
		
		foreach ($this->styles as $style => $temp) {
			$styleTag .= '<link rel="stylesheet" href="' . $style . '"/>' . "\n\t\t";
		}
		
		return $styleTag;
	}
	
	private function setScripts() {
		$scriptTag = '';
		
		foreach ($this->scripts as $script => $temp) {
			$scriptTag .= '<script src="' . $script . '"></script>' . "\n\t\t";
		}
		
		return $scriptTag;	
	}
	
	private function setMetas() {
		$metaTag = '';

		foreach ($this->meta as $meta) {
			
			$name 		= (!empty($meta['name'])) ? 'name="' . $meta['name'] . '" ' : '';
			$property	= (!empty($meta['property'])) ? 'property="' . $meta['property'] . '" ' : '';
			
			$metaTag .= '<meta ' . $name . $property . 'content="' . $meta['content'] . '" />' . "\n\t\t";
		}

		return $metaTag;
	}

}