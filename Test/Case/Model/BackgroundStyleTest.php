<?php
App::uses('BackgroundStyle', 'Model');

/**
 * BackgroundStyle Test Case
 *
 */
class BackgroundStyleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.background_style',
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
		'app.background_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BackgroundStyle = ClassRegistry::init('BackgroundStyle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BackgroundStyle);

		parent::tearDown();
	}

}
