<?php
/**
 * ProductCoverFixture
 *
 */
class ProductCoverFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'width' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2'),
		'height' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2'),
		'bleed' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2'),
		'wrap' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'product_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'width' => 1,
			'height' => 1,
			'bleed' => 1,
			'wrap' => 1,
			'created' => '2013-09-05 16:56:51',
			'modified' => '2013-09-05 16:56:51'
		),
	);

}
