<?php
App::uses('PrinterProduct', 'Model');

/**
 * PrinterProduct Test Case
 *
 */
class PrinterProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.printer_product',
		'app.product',
		'app.product_paperweight',
		'app.printer',
		'app.membership',
		'app.product_papertype',
		'app.product_cover',
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
		$this->PrinterProduct = ClassRegistry::init('PrinterProduct');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PrinterProduct);

		parent::tearDown();
	}

}
