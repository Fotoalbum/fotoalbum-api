<?php
App::uses('AppModel', 'Model');
/**
 * StickerStyle Model
 *
 * @property Sticker $Sticker
 * @property Style $Style
 */
class StickerStyle extends AppModel {

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
		'sticker_id' => array(
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
		'Sticker' => array(
			'className' => 'Sticker',
			'foreignKey' => 'sticker_id',
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
