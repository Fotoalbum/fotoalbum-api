<?php
App::uses('Pagelayout', 'Model');

/**
 * Pagelayout Test Case
 *
 */
class PagelayoutTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pagelayout'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Pagelayout = ClassRegistry::init('Pagelayout');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Pagelayout);

		parent::tearDown();
	}

}
