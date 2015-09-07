<?php
/**
 * ProductSingleItemContainerFixture
 *
 */
class ProductSingleItemContainerFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'product_single_item_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'x' => array('type' => 'integer', 'null' => false, 'default' => null),
		'y' => array('type' => 'integer', 'null' => false, 'default' => null),
		'width' => array('type' => 'integer', 'null' => true, 'default' => null),
		'height' => array('type' => 'integer', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'product_single_item_id' => 1,
			'x' => 1,
			'y' => 1,
			'width' => 1,
			'height' => 1,
			'modified' => '2014-05-12 13:27:17',
			'created' => '2014-05-12 13:27:17'
		),
	);

}
