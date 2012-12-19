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

class Test {

	/**
	 * @var array
	 */
	private $testCases = array();

	/**
	 * @var array
	*/
	private $reports = array();

	/**
	 * @return array
	*/
	public function run() {
		foreach ($this->testCases as $testCase) { /* @var $testCase Test\TestCase */

			$tests = get_class_methods($testCase);

			$report = array(
					'test'		=> get_class($testCase),
					'success' 	=> 0,
					'failure' 	=> 0,
					'errors'	=> array(),
					'start' 	=> microtime(true),
					'duration' 	=> 0,
			);

			// Iterate over all testCase tests
			foreach ($tests as $test) {
				if (0 === strpos($test, 'test')) {

					$status = true;

					try {
						// Start of test procedures
						$testCase->setUp();

						// Test procedures
						$testCase->$test();

						// End of test procedures
						$testCase->tearDown();
					} catch (\Exception $e) {
						$status = false;
						$report['errors'][] = 'Test: ' . $report['test'] . '::' . $test . '() faild with message: "' . $e->getMessage() . '"';
					}

					if ($status) {
						$report['success']++;
					}
					else {
						$report['failure']++;
					}

				}
			}
			
			$report['duration'] = number_format(microtime(true) - $report['start'], 20);
			
			$this->reports[] = $report;

		}

		return $this->reports;
	}

	/**
	 * @param Test\TestCase $testCase
	 * @return Test
	 */
	public function addTestCase(Test\TestCase $testCase) {
		$this->testCases[] = $testCase;
		return $this;
	}

}