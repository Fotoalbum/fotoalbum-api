<?php
/**
 * PrinterProductFixture
 *
 */
class PrinterProductFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'printer_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'product_cover_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'status' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 1, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'name' => 'Lorem ipsum dolor sit amet',
			'product_id' => 1,
			'printer_id' => 1,
			'product_cover_id' => 1,
			'status' => 'Lorem ipsum dolor sit ame',
			'created' => '2013-09-05 16:57:09',
			'modified' => '2013-09-05 16:57:09'
		),
	);

}
