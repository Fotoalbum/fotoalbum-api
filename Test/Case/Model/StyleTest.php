<?php
App::uses('Style', 'Model');

/**
 * Style Test Case
 *
 */
class StyleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		'app.sticker',
		'app.sticker_style',
		'app.sticker_type',
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
		$this->Style = ClassRegistry::init('Style');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Style);

		parent::tearDown();
	}

}
