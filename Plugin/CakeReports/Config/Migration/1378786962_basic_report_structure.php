<?php
class BasicReportStructure extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'create_table' => [
				'reports' => [
					'id' => [
						'type'    =>'string',
						'null'    => false,
						'default' => NULL,
						'length'  => 36,
						'key'     => 'primary'
					],
					'title' => [
						'type' => 'string',
						'length' => 32,
						'null' => false
					],
					'description' => [
						'type' => 'string',
						'null' => false,
						'default' => ''
					],
				],
				'questions' => [
					'id' => [
						'type'    =>'string',
						'null'    => false,
						'default' => NULL,
						'length'  => 36,
						'key'     => 'primary'
					],
					'report_id' => [
						'type'    =>'string',
						'null'    => false,
						'default' => NULL,
						'length'  => 36,
					],
					'short_name' => [
						'type' => 'string',
						'length' => 32,
						'null' => false,
						'default' => ''
					],
					'description' => [
						'type' => 'string',
						'null' => false,
					],
				],
				'responses' => [
					'id' => [
						'type'    =>'string',
						'null'    => false,
						'default' => NULL,
						'length'  => 36,
						'key'     => 'primary'
					],
					'report_id' => [
						'type'    =>'string',
						'null'    => false,
						'default' => NULL,
						'length'  => 36,
					],
				],
				'answers' => [
					'id' => [
						'type'    =>'string',
						'null'    => false,
						'default' => NULL,
						'length'  => 36,
						'key'     => 'primary'
					],
					'response_id' => [
						'type'    =>'string',
						'null'    => false,
						'default' => NULL,
						'length'  => 36,
					],
					'question_id' => [
						'type'    =>'string',
						'null'    => false,
						'default' => NULL,
						'length'  => 36,
					],
					'answer_text' => [
						'type' => 'string',
						'null' => false,
					],
				],

			],
		),
		'down' => array(
			'drop_table' => [
				'reports',
				'questions',
				'responses',
				'answers'
			]
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function after($direction) {
		return true;
	}
}
