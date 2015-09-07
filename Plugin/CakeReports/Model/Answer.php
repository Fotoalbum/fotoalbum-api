<?php
App::uses('CakeReportsAppModel', 'CakeReports.Model');
/**
 * Answer Model
 *
 * @property Response $Response
 * @property Question $Question
 */
class Answer extends CakeReportsAppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'answer_text' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Response' => array(
			'className' => 'Response',
			'foreignKey' => 'response_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
