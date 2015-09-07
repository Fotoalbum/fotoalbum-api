<?php
App::uses('AppModel', 'Model');
/**
 * BackgroundStyle Model
 *
 * @property Background $Background
 * @property Style $Style
 */
class BackgroundStyle extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'cms_app';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'background_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'style_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Background' => array(
			'className' => 'Background',
			'foreignKey' => 'background_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Style' => array(
			'className' => 'Style',
			'foreignKey' => 'style_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}