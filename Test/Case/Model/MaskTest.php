<?php
App::uses('Mask', 'Model');

/**
 * Mask Test Case
 *
 */
class MaskTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mask',
		'app.category',
		'app.style',
		'app.type',
		'app.mask_style',
		'app.mask_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Mask = ClassRegistry::init('Mask');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mask);

		parent::tearDown();
	}

}
