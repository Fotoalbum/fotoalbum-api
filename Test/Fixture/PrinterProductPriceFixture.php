<?php
/**
 * PrinterProductPriceFixture
 *
 */
class PrinterProductPriceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'printer_product_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'min_page' => array('type' => 'integer', 'null' => false, 'default' => '1'),
		'max_page' => array('type' => 'integer', 'null' => true, 'default' => null),
		'product_price' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2'),
		'handling_price' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2'),
		'page_price' => array('type' => 'float', 'null' => true, 'default' => '0.0000', 'length' => '10,4'),
		'method' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'printer_product_id' => 1,
			'min_page' => 1,
			'max_page' => 1,
			'product_price' => 1,
			'handling_price' => 1,
			'page_price' => 1,
			'method' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-09-05 16:56:52',
			'modified' => '2013-09-05 16:56:52'
		),
	);

}
