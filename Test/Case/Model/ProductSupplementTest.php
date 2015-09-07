<?php
App::uses('ProductSupplement', 'Model');

/**
 * ProductSupplement Test Case
 *
 */
class ProductSupplementTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_supplement',
		'app.product',
		'app.product_paperweight',
		'app.printer',
		'app.membership',
		'app.printer_product',
		'app.product_cover',
		'app.product_papertype',
		'app.product_finish',
		'app.printer_product_cover',
		'app.printer_product_price',
		'app.printer_product_spine',
		'app.product_color',
		'app.product_shape',
		'app.product_size',
		'app.product_single',
		'app.product_single_item',
		'app.product_single_item_container',
		'app.product_single_container',
		'app.category',
		'app.user',
		'app.categorized',
		'app.supplement'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductSupplement = ClassRegistry::init('ProductSupplement');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductSupplement);

		parent::tearDown();
	}

}
