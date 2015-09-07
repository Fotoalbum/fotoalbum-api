<?php
App::uses('ProductSingleItem', 'Model');

/**
 * ProductSingleItem Test Case
 *
 */
class ProductSingleItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_single_item',
		'app.xhibit_product_single'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductSingleItem = ClassRegistry::init('ProductSingleItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductSingleItem);

		parent::tearDown();
	}

}
