<?php
/**
 * MaskFixture
 *
 */
class MaskFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'category_id' => array('type' => 'biginteger', 'null' => true, 'default' => null, 'length' => 11),
		'style_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'type_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'directory' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'hires' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'bytesize' => array('type' => 'integer', 'null' => false, 'default' => null),
		'width' => array('type' => 'integer', 'null' => false, 'default' => null),
		'height' => array('type' => 'integer', 'null' => false, 'default' => null),
		'metatags' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
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
			'id' => '',
			'name' => 'Lorem ipsum dolor sit amet',
			'category_id' => '',
			'style_id' => 1,
			'type_id' => 1,
			'directory' => 'Lorem ipsum dolor sit amet',
			'hires' => 'Lorem ipsum dolor sit amet',
			'bytesize' => 1,
			'width' => 1,
			'height' => 1,
			'metatags' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2013-09-26 14:13:46',
			'modified' => '2013-09-26 14:13:46'
		),
	);

}
