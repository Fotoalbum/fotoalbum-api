<?php
App::uses('Error', 'Model');

/**
 * Error Test Case
 *
 */
class ErrorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.error',
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
		'app.product_single_container',
		'app.user_product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Error = ClassRegistry::init('Error');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Error);

		parent::tearDown();
	}

}
