<?php
App::uses('Logstag', 'Model');

/**
 * Logstag Test Case
 *
 */
class LogstagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.logstag',
		'app.log',
		'app.user',
		'app.tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Logstag = ClassRegistry::init('Logstag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Logstag);

		parent::tearDown();
	}

}
