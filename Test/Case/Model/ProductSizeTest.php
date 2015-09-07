<?php
App::uses('ProductSize', 'Model');

/**
 * ProductSize Test Case
 *
 */
class ProductSizeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_size',
		'app.printer',
		'app.membership',
		'app.printer_product',
		'app.product',
		'app.product_paperweight',
		'app.product_cover',
		'app.product_papertype',
		'app.category',
		'app.product_single',
		'app.product_single_item',
		'app.product_single_item_container',
		'app.product_single_container',
		'app.printer_product_cover',
		'app.printer_product_price',
		'app.printer_product_spine'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductSize = ClassRegistry::init('ProductSize');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductSize);

		parent::tearDown();
	}

}
