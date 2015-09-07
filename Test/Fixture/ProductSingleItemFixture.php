<?php
/**
 * ProductSingleItemFixture
 *
 */
class ProductSingleItemFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'xhibit_product_single_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'x' => array('type' => 'integer', 'null' => false, 'default' => null),
		'y' => array('type' => 'integer', 'null' => false, 'default' => null),
		'colors' => array('type' => 'integer', 'null' => false, 'default' => null),
		'price' => array('type' => 'integer', 'null' => false, 'default' => null),
		'zChangeable' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'removeable' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'draggable' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'rotatable' => array('type' => 'integer', 'null' => false, 'default' => null),
		'resizeable' => array('type' => 'integer', 'null' => false, 'default' => null),
		'default' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_bin', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'xhibit_product_single_id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'x' => 1,
			'y' => 1,
			'colors' => 1,
			'price' => 1,
			'zChangeable' => 1,
			'removeable' => 1,
			'draggable' => 1,
			'rotatable' => 1,
			'resizeable' => 1,
			'default' => 'Lorem ipsum dolor sit amet',
			'modified' => '2013-10-29 14:35:52',
			'created' => '2013-10-29 14:35:52',
			'status' => 1
		),
	);

}
