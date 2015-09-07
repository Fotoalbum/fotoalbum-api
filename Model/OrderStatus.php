<?php
App::uses('AppModel', 'Model');
/**
 * OrderStatus Model
 *
 */
class OrderStatus extends AppModel {
	public $name 			= 'OrderStatus';
	public $useDbConfig 	= 'albumviewer'; 
	public $useTable 		= 'order_status';
}

?>