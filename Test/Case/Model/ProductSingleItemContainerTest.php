<?php
App::uses('ProductSingleItemContainer', 'Model');

/**
 * ProductSingleItemContainer Test Case
 *
 */
class ProductSingleItemContainerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_single_item_container',
		'app.product_single_item',
		'app.product_single',
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
		'app.product_single_container'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductSingleItemContainer = ClassRegistry::init('ProductSingleItemContainer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductSingleItemContainer);

		parent::tearDown();
	}

}
