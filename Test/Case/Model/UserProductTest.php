<?php
App::uses('UserProduct', 'Model');

/**
 * UserProduct Test Case
 *
 */
class UserProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_product',
		'app.user',
		'app.product',
		'app.product_paperweight',
		'app.printer',
		'app.membership',
		'app.printer_product',
		'app.product_cover',
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
		$this->UserProduct = ClassRegistry::init('UserProduct');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserProduct);

		parent::tearDown();
	}

}
