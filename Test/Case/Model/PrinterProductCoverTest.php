<?php
App::uses('PrinterProductCover', 'Model');

/**
 * PrinterProductCover Test Case
 *
 */
class PrinterProductCoverTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.printer_product_cover',
		'app.printer_product',
		'app.product',
		'app.product_paperweight',
		'app.printer',
		'app.membership',
		'app.product_papertype',
		'app.product_cover',
		'app.category',
		'app.product_single',
		'app.product_single_item',
		'app.product_single_container',
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
		$this->PrinterProductCover = ClassRegistry::init('PrinterProductCover');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PrinterProductCover);

		parent::tearDown();
	}

}
