<?php
App::uses('AppModel', 'Model');
/**
 * PrinterProductPrice Model
 *
 * @property PrinterProduct $PrinterProduct
 */
class PrinterProductPrice extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'printer_product_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'min_page' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'method' => array(
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
		'PrinterProduct' => array(
			'className' => 'PrinterProduct',
			'foreignKey' => 'printer_product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function afterFind($results, $primary = false) {
		foreach ($results as $key => $val) {
			if (isset($results[$key]['PrinterProductPrice']))
			{
				$results[$key]['PrinterProductPrice']['shop_price'] = $val['PrinterProductPrice']['product_price'] + $val['PrinterProductPrice']['handling_price'];
				if (isset($val['PrinterProductPrice']['method']))
				{
					switch ($val['PrinterProductPrice']['method'])
					{
						case 1:
							$results[$key]['PrinterProductPrice']['shop_price'] = $val['PrinterProductPrice']['product_price'] + $val['PrinterProductPrice']['handling_price'];					
						break;
						
						case 2:
							$results[$key]['PrinterProductPrice']['shop_price'] = ($val['PrinterProductPrice']['min_page'] * $val['PrinterProductPrice']['page_price']) + $val['PrinterProductPrice']['handling_price'];					
						break;
						
						case 3:
							$results[$key]['PrinterProductPrice']['shop_price'] = ($val['PrinterProductPrice']['min_page'] * $val['PrinterProductPrice']['page_price']) + $val['PrinterProductPrice']['handling_price'] + $val['PrinterProductPrice']['product_price'];	
						break;
						
						case 4:
							$results[$key]['PrinterProductPrice']['shop_price'] = (1 * $val['PrinterProductPrice']['page_price']) + $val['PrinterProductPrice']['handling_price'] + $val['PrinterProductPrice']['product_price'];	
						break;				
						
						default:
							$results[$key]['PrinterProductPrice']['shop_price'] = $val['PrinterProductPrice']['handling_price'] + $val['PrinterProductPrice']['product_price'];	
						break;
					}
				}
				$results[$key]['PrinterProductPrice']['shop_price'] 				= sprintf('%01.2f', $results[$key]['PrinterProductPrice']['shop_price'] + ($results[$key]['PrinterProductPrice']['shop_price'] * (Configure::read('affiliate.company.payment.tax')/100) ) );
				$results[$key]['PrinterProductPrice']['shop_page_price'] 			= sprintf('%01.2f', $val['PrinterProductPrice']['page_price'] + ($val['PrinterProductPrice']['page_price'] * (Configure::read('affiliate.company.payment.tax')/100) ) );
				$results[$key]['PrinterProductPrice']['shop_product_price']			= sprintf('%01.2f', $results[$key]['PrinterProductPrice']['shop_price'] );
				$results[$key]['PrinterProductPrice']['shop_product_page_price'] 	= sprintf('%01.2f', $val['PrinterProductPrice']['page_price'] );
				$results[$key]['PrinterProductPrice']['shop_price_method'] 			= $val['PrinterProductPrice']['method'];
				$results[$key]['PrinterProductPrice']['vat_rate'] 					= Configure::read('affiliate.company.payment.tax')/100;
			}
		}
		return $results;
	}	
	
}
