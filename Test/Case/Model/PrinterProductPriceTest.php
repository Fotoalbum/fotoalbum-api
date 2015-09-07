<?php
App::uses('PrinterProductPrice', 'Model');

/**
 * PrinterProductPrice Test Case
 *
 */
class PrinterProductPriceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.printer_product_price',
		'app.printer_product',
		'app.product',
		'app.product_paperweight',
		'app.printer',
		'app.membership',
		'app.product_papertype',
		'app.product_cover',
		'app.printer_product_spine'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PrinterProductPrice = ClassRegistry::init('PrinterProductPrice');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PrinterProductPrice);

		parent::tearDown();
	}

}
