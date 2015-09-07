<?php
App::uses('BackgroundType', 'Model');

/**
 * BackgroundType Test Case
 *
 */
class BackgroundTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.background_type',
		'app.background',
		'app.style',
		'app.mask',
		'app.type',
		'app.sticker',
		'app.sticker_style',
		'app.sticker_type',
		'app.category',
		'app.user',
		'app.categorized',
		'app.tag',
		'app.tagged',
		'app.mask_style',
		'app.mask_type',
		'app.background_style'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BackgroundType = ClassRegistry::init('BackgroundType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BackgroundType);

		parent::tearDown();
	}

}
