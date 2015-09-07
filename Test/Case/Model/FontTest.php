<?php
App::uses('Font', 'Model');

/**
 * Font Test Case
 *
 */
class FontTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.font'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Font = ClassRegistry::init('Font');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Font);

		parent::tearDown();
	}

}
