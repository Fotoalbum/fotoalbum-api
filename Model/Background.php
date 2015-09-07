<?php
App::uses('AppModel', 'Model');
/**
 * Background Model
 *
 * @property Category $Category
 * @property Style $Style
 * @property Type $Type
 * @property BackgroundStyle $BackgroundStyle
 * @property BackgroundType $BackgroundType
 */
class Background extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'cms_app';
	
	public $virtualFields = array(
		'lowres' => 'CONCAT("lowres_", Background.hires)',
		'thumb' => 'CONCAT("thumb_", Background.hires)',
		'path' => 'CONCAT("files/background/hires/",Background.id,"/")',
		'full_path' => 'CONCAT("/data/XHIBIT/api.xhibit.com/v2/files/background/hires/",Background.id,"/")',
		'hires_url' => 'CONCAT("files/background/hires/",Background.id,"/",Background.hires)',
		'lowres_url' => 'CONCAT("files/background/hires/",Background.id,"/lowres_", Background.hires)',
		'thumb_url' => 'CONCAT("files/background/hires/",Background.id,"/thumb_", Background.hires)',				
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
			//'conditions' => array('Style.foreign_model'=>'Background'),
			'fields' => '',
			'order' => ''
		),
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'type_id',
			'conditions' => array('Type.foreign_model'=>'Background'),
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
		'BackgroundStyle' => array(
			'className' => 'BackgroundStyle',
			'foreignKey' => 'background_id',
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
		'BackgroundType' => array(
			'className' => 'BackgroundType',
			'foreignKey' => 'background_id',
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
			'conditions' => array('Categorized.model'=>'Background'),
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
