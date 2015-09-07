<?php
App::uses('AppModel', 'Model');
/**
 * Debuglog Model
 *
 * @property User $User
 * @property Product $Product
 * @property UserProduct $UserProduct
 */
class Debuglog extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UserProduct' => array(
			'className' => 'UserProduct',
			'foreignKey' => 'user_product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
