<?php
App::uses('StickerType', 'Model');

/**
 * StickerType Test Case
 *
 */
class StickerTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sticker_type',
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
		'app.sticker_style'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->StickerType = ClassRegistry::init('StickerType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StickerType);

		parent::tearDown();
	}

}
