<?php
App::uses('AppModel', 'Model');
/**
 * ProductCover Model
 *
 * @property Product $Product
 * @property PrinterProduct $PrinterProduct
 */
class ProductCover extends AppModel {


	public $displayField = 'name';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'product_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed



	public $belongsTo = array(
		'ProductPaperweight' => array(
			'className' => 'ProductPaperweight',
			'foreignKey' => 'product_paperweight_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ProductPapertype' => array(
			'className' => 'ProductPapertype',
			'foreignKey' => 'product_papertype_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ProductFinish' => array(
			'className' => 'ProductFinish',
			'foreignKey' => 'product_finish_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PrinterProduct' => array(
			'className' => 'PrinterProduct',
			'foreignKey' => 'product_cover_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_cover_id',
			'dependent' => false,
			'conditions' => '',
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
