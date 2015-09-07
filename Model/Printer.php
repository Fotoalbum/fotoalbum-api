<?php
App::uses('AppModel', 'Model');
/**
 * Printer Model
 *
 * @property Membership $Membership
 * @property PrinterProduct $PrinterProduct
 * @property ProductPapertype $ProductPapertype
 * @property ProductPaperweight $ProductPaperweight
 */
class Printer extends AppModel {

	public $virtualFields = array(
		'lowres' => 'CONCAT("lowres_", Printer.filename)',
		'thumb' => 'CONCAT("thumb_", Printer.filename)',
		'path' => 'CONCAT("files/printer/",Printer.id,"/")',
		'full_path' => 'CONCAT("/data/XHIBIT/api.xhibit.com/v2/files/printer/",Printer.id,"/")',
		'filename_url' => 'CONCAT("files/printer/",Printer.id,"/",Printer.filename)',
		'lowres_url' => 'CONCAT("files/printer/",Printer.id,"/lowres_", Printer.filename)',
		'thumb_url' => 'CONCAT("files/printer/",Printer.id,"/thumb_", Printer.filename)',				
	);	
/**
 * Validation rules
 *
 * @var array
 */
 	public $actsAs = array(
		'Upload.Upload' => array(
			'filename'=>array(
				'thumbnailSizes' => array(
					'lowres' => '800l',
					'thumb' => '300l'
				),				
				'deleteOnUpdate' => false,
				'mimetypes' => array('image/jpeg','image/gif','image/png','application/octet-stream'),
				'extensions' => array('jpg','jpeg','gif','png'),
				'maxSize' => 200000000,
			)	
				
		)
	);
	
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
		'website' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'membership_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'filename' => array(
			'check_1' => array(
				'rule' => 'isUnderPhpSizeLimit',
				'message' => 'File exceeds upload filesize limit'
			),
			'check_2' => array(
				'rule' => 'isUnderFormSizeLimit',
				'message' => 'File exceeds form upload filesize limit'
			),
			'check_3' => array(
				'rule' => 'isCompletedUpload',
				'message' => 'File was not successfully uploaded'
			),
			'check_4' => array(
				'rule' => 'isFileUpload',
				'message' => 'File was missing from submission'
			),
			'check_6' => array(
				'rule' => 'isSuccessfulWrite',
				'message' => 'File was unsuccessfully written to the server'
			),
			'check_7' => array(
				'rule' => 'noPhpExtensionErrors',
				'message' => 'File was not uploaded because of a faulty PHP extension'
			),
			'check_8' => array(
				'rule' => array('isWritable'),
				'message' => 'File upload directory was not writable'
			),
			'check_9' => array(
				'rule' => array('isValidDir'),
				'message' => 'File upload directory does not exist'
			),
		)
		
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Membership' => array(
			'className' => 'Membership',
			'foreignKey' => 'membership_id',
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
			'foreignKey' => 'printer_id',
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
		'ProductPapertype' => array(
			'className' => 'ProductPapertype',
			'foreignKey' => 'printer_id',
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
		'ProductPaperweight' => array(
			'className' => 'ProductPaperweight',
			'foreignKey' => 'printer_id',
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
