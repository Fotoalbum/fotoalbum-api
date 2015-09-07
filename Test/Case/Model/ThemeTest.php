<?php
App::uses('Theme', 'Model');

/**
 * Theme Test Case
 *
 */
class ThemeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.theme',
		'app.user',
		'app.product',
		'app.product_paperweight',
		'app.printer',
		'app.membership',
		'app.printer_product',
		'app.product_cover',
		'app.product_papertype',
		'app.printer_product_price',
		'app.printer_product_spine',
		'app.printer_product_cover',
		'app.category',
		'app.product_single',
		'app.product_single_item',
		'app.product_single_container'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Theme = ClassRegistry::init('Theme');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Theme);

		parent::tearDown();
	}

}
