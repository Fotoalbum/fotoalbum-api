<?php
App::uses('ProductPaperweight', 'Model');

/**
 * ProductPaperweight Test Case
 *
 */
class ProductPaperweightTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_paperweight',
		'app.printer',
		'app.membership',
		'app.printer_product',
		'app.product',
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
		$this->ProductPaperweight = ClassRegistry::init('ProductPaperweight');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductPaperweight);

		parent::tearDown();
	}

}
