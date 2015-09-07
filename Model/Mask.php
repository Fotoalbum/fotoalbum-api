<?php
App::uses('AppModel', 'Model');
/**
 * Mask Model
 *
 * @property Category $Category
 * @property Style $Style
 * @property Type $Type
 * @property MaskStyle $MaskStyle
 * @property MaskType $MaskType
 */
class Mask extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'cms_app';
	
	public $virtualFields = array(
		'lowres' => 'CONCAT("lowres_", Mask.hires)',
		'thumb' => 'CONCAT("thumb_", Mask.hires)',
		'path' => 'CONCAT("files/mask/hires/",Mask.id,"/")',
		'full_path' => 'CONCAT("/data/XHIBIT/api.xhibit.com/v2/files/mask/hires/",Mask.id,"/")',
		'hires_url' => 'CONCAT("files/mask/hires/",Mask.id,"/",Mask.hires)',
		'lowres_url' => 'CONCAT("files/mask/hires/",Mask.id,"/lowres_", Mask.hires)',
		'thumb_url' => 'CONCAT("files/mask/hires/",Mask.id,"/thumb_", Mask.hires)',	
		
		'overlay_lowres' => 'CONCAT("lowres_", Mask.overlay_hires)',
		'overlay_thumb' => 'CONCAT("thumb_", Mask.overlay_hires)',
		'overlay_path' => 'CONCAT("files/mask/overlay_hires/",Mask.id,"/")',
		'overlay_full_path' => 'CONCAT("/data/XHIBIT/api.xhibit.com/v2/files/mask/overlay_hires/",Mask.id,"/")',
		'overlay_hires_url' => 'CONCAT("files/mask/overlay_hires/",Mask.id,"/",Mask.overlay_hires)',
		'overlay_lowres_url' => 'CONCAT("files/mask/overlay_hires/",Mask.id,"/lowres_", Mask.overlay_hires)',
		'overlay_thumb_url' => 'CONCAT("files/mask/overlay_hires/",Mask.id,"/thumb_", Mask.overlay_hires)',			
					
	);	
	
	public $actsAs = array(
		'Tags.Taggable' => array(
			'field'=>'metatags'
		),
		'Upload.Upload' => array(
			'hires'=>array(
				'fields' => array(
					'dir' => 'directory'
				),
				'thumbnailSizes' => array(
					'lowres' => '800l',
					'thumb' => '300l'
				),				
				'deleteOnUpdate' => false,
				'mimetypes' => array('image/jpeg','image/gif','image/png','application/octet-stream'),
				'extensions' => array('jpg','jpeg','gif','png'),
				'maxSize' => 200000000,
			),
			'overlay_hires'=>array(
				'fields' => array(
					'overlay_dir' => 'directory'
				),
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
		'hires' => array(
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
		),
		'overlay_hires' => array(
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
		'Style' => array(
			'className' => 'Style',
			'foreignKey' => 'style_id',
			//'conditions' => array('Style.foreign_model'=>'Mask'),
			'fields' => '',
			'order' => ''
		),
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'type_id',
			'conditions' => array('Type.foreign_model'=>'Mask'),
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
		'MaskStyle' => array(
			'className' => 'MaskStyle',
			'foreignKey' => 'mask_id',
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
		'MaskType' => array(
			'className' => 'MaskType',
			'foreignKey' => 'mask_id',
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
	
/**
 * belongsTo associations
 *
 * @var array
 */
    public $hasAndBelongsToMany = array(
        'Category' => array(
            'className' => 'Categories.Category',
            'foreignKey' => 'foreign_key',
            'associationForeignKey' => 'category_id',
            'with' => 'Categories.Categorized',
			'conditions' => array('Categorized.model'=>'Mask'),
        )
    );
	
    public function categorize($articleId, $categoryId) {
        $this->Categorized->save(array(
            'category_id' => $categoryId,
            'foreign_key' => $articleId,
            'model' => $this->alias
        ));
    }	
	
	

}
