<?php
App::uses('Background', 'Model');

/**
 * Background Test Case
 *
 */
class BackgroundTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.background',
		'app.category',
		'app.style',
		'app.type',
		'app.background_style',
		'app.background_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Background = ClassRegistry::init('Background');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Background);

		parent::tearDown();
	}

}
