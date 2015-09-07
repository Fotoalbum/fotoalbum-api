<?php
App::uses('MaskType', 'Model');

/**
 * MaskType Test Case
 *
 */
class MaskTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mask_type',
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
		'app.mask_style'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MaskType = ClassRegistry::init('MaskType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MaskType);

		parent::tearDown();
	}

}
