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

abstract class Controller extends Plugin {
	
	/**
	 * @var View
	 */
	protected $view = null;
	
	public function initAction() {
		$this->getView()->setRendered();
	}
	
	/**
	 * @param \Exception $e
	 * @throws \Exception
	 */
	public function errorAction(\Exception $e) {
		throw $e;
	}
	
	/**
	 * @param View $view
	 * @return Controller
	 */
	public function setView(View $view) {
		$this->view = $view;
		return $this;
	}
	
	/**
	 * @return View
	 */
	protected  function getView() {
		return $this->view;
	}
	
	/* Controller Helpers -> this will be implemented as external files in feature version  */
	
	/**
	 * @param string $zone
	 * @param string $controller
	 * @param string $action
	 * @param mixed $vars
	 * @throws \Exception
	 * @return bool
	 */
	protected  function getAction($zone, $controller, $action, $vars = null) {
		if (null == $zone) {
			//throw new \Exception('Can\'t echo action directly from controller');
		}
		
		return $this->getApp()->mvc->getAction($zone, $controller, $action, $vars);
	}
	
	/**
	 * @param string $key
	 * @param string $value
	 * @return Controller
	 */
	protected function setParam($key, $value) {
		$this->getView()->setParam($key, $value);
		return $this;
	}
	
	/**
	 * @param string $key
	 * @param mixed $default (optional)
	 * @return mixed
	 */
	protected function getParam($key, $default = null) {
		return $this->getView()->getParam($key, $default);
	}
	
	/**
	 * @param array $data
	 */
	protected function json(array $data) {
		$this->getResponse()->setContentType(Response::_CONTENT_TYPE_JSON); /* Set Content Type */
		$this->getLayout()
			->setRendered()
			->setParam(Mvc::_DEFAULT_ZONE, json_encode($data)); /* Append json string to output tag */
	}

	/**
	 * @param string $callback
	 * @param array $data
	 */
	protected function jsonp($callback, array $data) {
		$this->getResponse()->setContentType(Response::_CONTENT_TYPE_JAVASCRIPT); /* Set Content Type */
		$this->getLayout()
			->setRendered()
			->setParam(Mvc::_DEFAULT_ZONE, 'parent.' . $callback . '(' . json_encode($data) . ');'); /* Append json string to output tag */
	}

	/**
	 * @param object $data
	 * @return mixed
	 */
	protected function xml(array $data) {
		$xml	= new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><root />');
		$this->arr2xml($data, $xml);
		
		$this->getResponse()->setContentType(Response::_CONTENT_TYPE_XML); /* Set Content Type */
		$this->getLayout()
		->setRendered()
			->setParam(Mvc::_DEFAULT_ZONE, $xml->asXML()); /* Append XML string to output tag */
	}

	/**
	 * @param string $callback
	 * @param array $data
	 */
	protected function iframe($callback, array $data) {
		$this->getLayout()
			->setRendered()
			->setParam(Mvc::_DEFAULT_ZONE, '<script type="text/javascript">window.parent.' . $callback . '(' . json_encode($data) . ');</script>'); /* Append json string to output tag */
	}
}