<?php
App::uses('AppModel', 'Model');
/**
 * Sticker Model
 *
 * @property Category $Category
 * @property Style $Style
 * @property Type $Type
 * @property StickerStyle $StickerStyle
 * @property StickerType $StickerType
 */
class Sticker extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'cms_app';
	
	public $virtualFields = array(
		'lowres' => 'CONCAT("lowres_", Sticker.hires)',
		'thumb' => 'CONCAT("thumb_", Sticker.hires)',
		'path' => 'CONCAT("files/sticker/hires/",Sticker.id,"/")',
		'full_path' => 'CONCAT("/data/XHIBIT/api.xhibit.com/v2/files/sticker/hires/",Sticker.id,"/")',
		'hires_url' => 'CONCAT("files/sticker/hires/",Sticker.id,"/",Sticker.hires)',
		'lowres_url' => 'CONCAT("files/sticker/hires/",Sticker.id,"/lowres_", Sticker.hires)',
		'thumb_url' => 'CONCAT("files/sticker/hires/",Sticker.id,"/thumb_", Sticker.hires)',	
		'price' => '0.00',				
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
			//'conditions' => array('Style.foreign_model'=>'Sticker'),
			'fields' => '',
			'order' => ''
		),
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'type_id',
			'conditions' => array('Type.foreign_model'=>'Sticker'),
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
		'StickerStyle' => array(
			'className' => 'StickerStyle',
			'foreignKey' => 'sticker_id',
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
		'StickerType' => array(
			'className' => 'StickerType',
			'foreignKey' => 'sticker_id',
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
			'conditions' => array('Categorized.model'=>'Sticker'),
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
