<?php
/**
 * PrinterProductCoverFixture
 *
 */
class PrinterProductCoverFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'printer_product_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'hardbound' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'hardbound_type' => array('type' => 'string', 'null' => true, 'default' => 'glued', 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'headbandcolor' => array('type' => 'string', 'null' => false, 'default' => 'Wit', 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'endpapercolor' => array('type' => 'string', 'null' => false, 'default' => 'Wit', 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'spineform' => array('type' => 'string', 'null' => false, 'default' => 'Rond', 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'laminate' => array('type' => 'string', 'null' => false, 'default' => 'Eenzijdig glanzend laminaat', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'hardbound' => 1,
			'hardbound_type' => 'Lorem ipsum dolor sit amet',
			'headbandcolor' => 'Lorem ipsum dolor sit amet',
			'endpapercolor' => 'Lorem ipsum dolor sit amet',
			'spineform' => 'Lorem ipsum dolor sit amet',
			'laminate' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-12-10 22:28:59',
			'modified' => '2013-12-10 22:28:59'
		),
	);

}
