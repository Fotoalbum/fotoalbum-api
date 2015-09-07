<?php
App::uses('StickerStyle', 'Model');

/**
 * StickerStyle Test Case
 *
 */
class StickerStyleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sticker_style',
		'app.sticker',
		'app.style',
		'app.background',
		'app.type',
		'app.mask',
		'app.mask_style',
		'app.mask_type',
		'app.category',
		'app.user',
		'app.categorized',
		'app.tag',
		'app.tagged',
		'app.background_style',
		'app.background_type',
		'app.sticker_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->StickerStyle = ClassRegistry::init('StickerStyle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StickerStyle);

		parent::tearDown();
	}

}
