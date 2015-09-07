<?php
/**
 * PrinterProductSpineFixture
 *
 */
class PrinterProductSpineFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'printer_product_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'min_page' => array('type' => 'integer', 'null' => false, 'default' => null),
		'max_page' => array('type' => 'integer', 'null' => false, 'default' => null),
		'value' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'base_value' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'method' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 1, 'comment' => '1=fixed, 2=per page,3=variable,4=base + pp'),
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
			'value' => 'Lorem ipsum dolor sit amet',
			'base_value' => 'Lorem ipsum dolor sit amet',
			'method' => 1,
			'created' => '2013-09-05 16:56:53',
			'modified' => '2013-09-05 16:56:53'
		),
	);

}
