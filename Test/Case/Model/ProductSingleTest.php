<?php
App::uses('ProductSingle', 'Model');

/**
 * ProductSingle Test Case
 *
 */
class ProductSingleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_single',
		'app.xhibit_product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductSingle = ClassRegistry::init('ProductSingle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductSingle);

		parent::tearDown();
	}

}
