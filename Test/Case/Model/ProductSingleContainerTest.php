<?php
App::uses('ProductSingleContainer', 'Model');

/**
 * ProductSingleContainer Test Case
 *
 */
class ProductSingleContainerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_single_container',
		'app.product_single',
		'app.product',
		'app.product_paperweight',
		'app.printer',
		'app.membership',
		'app.printer_product',
		'app.product_cover',
		'app.printer_product_price',
		'app.printer_product_spine',
		'app.product_papertype',
		'app.product_single_item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductSingleContainer = ClassRegistry::init('ProductSingleContainer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductSingleContainer);

		parent::tearDown();
	}

}
