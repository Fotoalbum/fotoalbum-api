<?php
App::uses('PrinterProductSpine', 'Model');

/**
 * PrinterProductSpine Test Case
 *
 */
class PrinterProductSpineTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.printer_product_spine',
		'app.printer_product',
		'app.product',
		'app.product_paperweight',
		'app.printer',
		'app.membership',
		'app.product_papertype',
		'app.product_cover',
		'app.printer_product_price'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PrinterProductSpine = ClassRegistry::init('PrinterProductSpine');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PrinterProductSpine);

		parent::tearDown();
	}

}
