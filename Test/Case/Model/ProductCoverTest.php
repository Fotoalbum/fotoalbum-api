<?php
App::uses('ProductCover', 'Model');

/**
 * ProductCover Test Case
 *
 */
class ProductCoverTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_cover',
		'app.product',
		'app.product_paperweight',
		'app.printer',
		'app.membership',
		'app.printer_product',
		'app.printer_product_price',
		'app.printer_product_spine',
		'app.product_papertype'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductCover = ClassRegistry::init('ProductCover');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductCover);

		parent::tearDown();
	}

}
