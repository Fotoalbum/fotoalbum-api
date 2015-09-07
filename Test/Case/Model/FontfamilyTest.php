<?php
App::uses('Fontfamily', 'Model');

/**
 * Fontfamily Test Case
 *
 */
class FontfamilyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.fontfamily'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Fontfamily = ClassRegistry::init('Fontfamily');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Fontfamily);

		parent::tearDown();
	}

}
