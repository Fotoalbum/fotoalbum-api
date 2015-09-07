<?php
/**
 * PagelayoutFixture
 *
 */
class PagelayoutFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'pagetype' => array('type' => 'integer', 'null' => true, 'default' => null),
		'pageshape' => array('type' => 'integer', 'null' => true, 'default' => null),
		'photoNum' => array('type' => 'integer', 'null' => true, 'default' => null),
		'stickerNum' => array('type' => 'integer', 'null' => true, 'default' => null),
		'textNum' => array('type' => 'integer', 'null' => true, 'default' => null),
		'layout' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
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
			'pagetype' => 1,
			'pageshape' => 1,
			'photoNum' => 1,
			'stickerNum' => 1,
			'textNum' => 1,
			'layout' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2013-09-26 14:13:45',
			'modified' => '2013-09-26 14:13:45'
		),
	);

}
