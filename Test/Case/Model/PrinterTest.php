<?php
App::uses('Printer', 'Model');

/**
 * Printer Test Case
 *
 */
class PrinterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.printer',
		'app.membership',
		'app.printer_product',
		'app.product',
		'app.product_paperweight',
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
		$this->Printer = ClassRegistry::init('Printer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Printer);

		parent::tearDown();
	}

}