<?php

namespace Utopia\Test;

abstract class TestCase {

	/**
	 *
	 */
	public function setUp() {
		;
	}

	/**
	 *
	 */
	public function tearDown() {
		;
	}
	
	/**
	 * @param int $expected
	 * @param array $actual
	 * @param string $message
	 * @throws \Exception
	 * @return boolean
	 */
	final protected function assertCount($expected, array $actual, $message = 'Faild to assert count') {
		if ($expected === count($actual)) {
			return true;
		}
	
		throw new \Exception($message);
	}
	
	/**
	 * @param mixed $expected
	 * @param mixed $actual
	 * @param mixed $message
	 * @throws \Exception
	 * @return boolean
	 */
	final protected function assertEquales($expected, $actual, $message = 'Faild to assert equal') {
		if ($expected == $actual) {
			return true;
		}
		
		throw new \Exception($message);
	}

	/**
	 * @param mixed $expected
	 * @param mixed $actual
	 * @param string $message
	 * @throws \Exception
	 * @return boolean
	 */
	final protected function assertInstanceOf($expected, $actual, $message = 'Faild to assert instance') {
		if ($expected instanceof $actual) {
			return true;
		}
	
		throw new \Exception($message);
	}

	/**
	 * @param mixed $expected
	 * @param mixed $actual
	 * @param string $message
	 * @throws \Exception
	 * @return boolean
	 */
	final protected function assertTrue($expected, $actual, $message = 'Faild to assert instance') {
		if ($expected instanceof $actual) {
			return true;
		}
	
		throw new \Exception($message);
	}
}