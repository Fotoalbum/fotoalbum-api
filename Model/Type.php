<?php
App::uses('AppModel', 'Model');
/**
 * Type Model
 *
 * @property Background $Background
 * @property Mask $Mask
 * @property Sticker $Sticker
 */
class Type extends AppModel {

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
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'foreign_model' => array(
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Background' => array(
			'className' => 'Background',
			'foreignKey' => 'type_id',
			'dependent' => false,
			//'conditions' => array('Type.foreign_model'=>'Background'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Mask' => array(
			'className' => 'Mask',
			'foreignKey' => 'type_id',
			'dependent' => false,
			//'conditions' => array('Type.foreign_model'=>'Mask'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Sticker' => array(
			'className' => 'Sticker',
			'foreignKey' => 'type_id',
			'dependent' => false,
			//'conditions' => array('Type.foreign_model'=>'Sticker'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
