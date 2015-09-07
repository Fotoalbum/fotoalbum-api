<?php
App::uses('AppModel', 'Model');
/**
 * OrderPdf Model
 *
 * @property Order $Order
 * @property OrderPdfUserProduct $OrderPdfUserProduct
 * @property PrinterProduct $PrinterProduct
 * @property User $User
 * @property OrderPdfDownload $OrderPdfDownload
 * @property OrderPdfExternal $OrderPdfExternal
 */
class OrderPdf extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'pdfengine';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'order_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'OrderPdfUserProduct' => array(
			'className' => 'OrderPdfUserProduct',
			'foreignKey' => 'order_pdf_user_product_id',
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
		'OrderPdfDownload' => array(
			'className' => 'OrderPdfDownload',
			'foreignKey' => 'order_pdf_id',
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
		'OrderPdfExternal' => array(
			'className' => 'OrderPdfExternal',
			'foreignKey' => 'order_pdf_id',
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
