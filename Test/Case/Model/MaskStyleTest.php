<?php
App::uses('MaskStyle', 'Model');

/**
 * MaskStyle Test Case
 *
 */
class MaskStyleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mask_style',
		'app.mask',
		'app.style',
		'app.background',
		'app.type',
		'app.sticker',
		'app.sticker_style',
		'app.sticker_type',
		'app.category',
		'app.user',
		'app.categorized',
		'app.tag',
		'app.tagged',
		'app.background_style',
		'app.background_type',
		'app.mask_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MaskStyle = ClassRegistry::init('MaskStyle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MaskStyle);

		parent::tearDown();
	}

}
