<?php
App::uses('Debugger', 'Model');

/**
 * Debugger Test Case
 *
 */
class DebuggerTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Debugger = ClassRegistry::init('Debugger');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Debugger);

		parent::tearDown();
	}

}
