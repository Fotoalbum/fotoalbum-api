<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');

/**
*       SoftwaresController
*
*       Interfaces Controller is the interface between the database and the software. This controller handles all requests to the database.
*
*       @author      Frank van der Stad <frank@vanderstad.nl>
*       @package     XHIBIT_SITE
**/

class SoftwaresController extends AppController {

	var $name = 'Softwares';
	
	var $_isConnected = false;

	var $cors_enabled = array();
	
	var $uses = array(
		'Software',
		'Background',
		'Color',	
		'Font',	
		'Pagelayout',		
		'Sticker',
		'OrderPdf',
		'Categories.Category'		
	);

 	var $components = array('RequestHandler','Auth', 'Session');
	
	var $ModelName = false;

	// -------------------------------------------------------------------

	/**
	*       beforeFilter
	*
	*       Add all allow
	*	*       @return         ArrayCollection
	**/
	function beforeFilter() 
	{
		parent::beforeFilter();

		$this->Auth->Allow();
		
		$this->cors_enabled = array(
			'http://api.xhibit.com',
			'http://www.xhibit.com',
			'http://beta.xhibit.com',
			'http://new.xhibit.com',
			'http://www.fotoalbum.nl',
			'http://mijn.fotoboek-maken.nl',
			'http://www.moments-to-share.nl',
			'http://enjoy.fotoalbum.nl',
			'http://www.fotoalbum.nl',
			'http://wwww.fotoalbum.be',			
		);												


		if( !defined("USE_ARRAY_COLLECTION_MAPPING") || USE_ARRAY_COLLECTION_MAPPING != true )
		{
				$this->response->header('Access-Control-Allow-Credentials', 'false');
				if (isset($_SERVER['HTTP_ORIGIN']))
				{
						if (in_array($_SERVER['HTTP_ORIGIN'],$this->cors_enabled))
						{
								$this->response->header('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN']);					
						}
				}
				else
				{
						foreach($this->cors_enabled as $cors_enabled)
						{
								$this->response->header('Access-Control-Allow-Origin', $cors_enabled);
						}
				}
				
				
				$this->response->header('Access-Control-Allow-Origin', '*');
				
				if ($this->request->is('OPTIONS') ) {
						$this->response->header('Access-Control-Allow-Methods', 'HEAD, GET, PUT, POST, OPTIONS, DELETE');
						$this->response->header('Access-Control-Max-Age', '604800');                        
						$this->response->header('Access-Control-Allow-Headers', 'Origin, Accept, Authorization, Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control');                        
						$this->response->send();
						exit(0);
				}
		}

		$this->autoRender = false;
		
		$user_database_source = $this->Session->read('connector.USERDB');
		if ( (isset($user_database_source)) && (!empty($user_database_source)) )
		{
			$this->LoadModel('User');
			$this->User->useDbConfig = $user_database_source;
		}
		
		
	}
	
	/***********************************************************************************************************/
	/*                                                SOFTWARE                                                 */
	/***********************************************************************************************************/

	// -------------------------------------------------------------------
	/**
	*       GetConfig
	*
	*		Return the config based on current host.
	*       
	*       @return         ArrayCollection
	**/
    function api_getConfig($platform = 'www', $locale = 'nld', $html = false) {
		
		$this->Session->write('platform',$platform);
		$this->Session->write('locale',$locale);
		
		if (isset($platform))
		{
			switch ($platform)
			{
				case 'www':
					Configure :: write('connector.WWWROOT', '/data/XHIBIT/www.xhibit.com/');
					Configure :: write('connector.HOST', 'http://www.xhibit.com/');
					Configure :: write('connector.APPDIR', '');	
					Configure :: write('Config.language', 'nld');	
					Configure :: write('connector.USERDB', 'albumviewer');

				break;
				
				case 'beta':
					Configure :: write('connector.WWWROOT', '/data/XHIBIT/beta.xhibit.com/staging');
					Configure :: write('connector.HOST', 'http://beta.xhibit.com/');
					Configure :: write('connector.APPDIR', 'staging/');	
					Configure :: write('Config.language', 'nld');	
					Configure :: write('connector.USERDB', 'albumviewer');
				break;
				
				case 'enjoy':
					Configure :: write('connector.WWWROOT', '/data/XHIBIT/api.xhibit.com/v2/files');
					Configure :: write('connector.HOST', 'http://enjoy.fotoalbum.nl/');
					Configure :: write('connector.APPDIR', '');	
					Configure :: write('Config.language', 'nld');	
					Configure :: write('connector.USERDB', 'albumviewer_crm');
				break;	
				
				case 'new':
					Configure :: write('connector.WWWROOT', '/data/XHIBIT/api.xhibit.com/v2/files');
					Configure :: write('connector.HOST', 'http://mijn.fotoboek-maken.nl/');
					Configure :: write('connector.APPDIR', '');	
					Configure :: write('Config.language', 'nld');	
					Configure :: write('connector.USERDB', 'albumviewer');
				break;				
			
				case 'fenf':
					Configure :: write('connector.WWWROOT', '/data/XHIBIT/api.xhibit.com/v2/files');
					Configure :: write('connector.HOST', 'http://mijn.fotoboek-maken.nl/');
					Configure :: write('connector.APPDIR', '');
					Configure :: write('Config.language', 'nld');	
					Configure :: write('connector.USERDB', 'albumviewer');					
				break;	
			
				case 'hampshire':
					Configure :: write('connector.WWWROOT', '/data/XHIBIT/api.xhibit.com/v2/files');
					Configure :: write('connector.HOST', 'http://www.moments-to-share.nl/hampshire/');
					Configure :: write('connector.APPDIR', '');	
					Configure :: write('Config.language', 'nld');	
					Configure :: write('connector.USERDB', 'albumviewer');					
				break;		
				
				case 'bonusboek':
					Configure :: write('connector.WWWROOT', '/data/XHIBIT/api.xhibit.com/v2/files');
					Configure :: write('connector.HOST', 'http://new.xhibit.com/');
					Configure :: write('connector.APPDIR', '');	
					Configure :: write('Config.language', 'nld');	
					Configure :: write('connector.USERDB', 'albumviewer');					
				break;	
								
				case 'cms':
					Configure :: write('connector.WWWROOT', '/data/XHIBIT/api.xhibit.com/v2/files');
					Configure :: write('connector.HOST', 'http://api.xhibit.com/v2/');
					Configure :: write('connector.APPDIR', '');	
					Configure :: write('Config.language', 'nld');	
					Configure :: write('connector.USERDB', 'albumviewer');					
				break;
				
				case 'fotoalbum_be':
					Configure :: write('connector.WWWROOT', '/data/XHIBIT/www.xhibit.com/');
					Configure :: write('connector.HOST', 'http://www.xhibit.com/');
					Configure :: write('connector.APPDIR', '');		
					Configure :: write('Config.language', 'nld');	
					Configure :: write('connector.USERDB', 'albumviewer');
				break;
				
				default:
					Configure :: write('connector.WWWROOT', '/data/XHIBIT/www.xhibit.com/');
					Configure :: write('connector.HOST', 'http://www.xhibit.com/');
					Configure :: write('connector.APPDIR', '');		
					Configure :: write('Config.language', 'nld');	
					Configure :: write('connector.USERDB', 'albumviewer');
				break;			
			}			
			
		}
				
		$this->Session->write('Config.language', Configure::read('Config.language'));  
		$this->Session->write('connector.USERDB', Configure::read('connector.USERDB'));  		

		$hostname 	= CakeRequest::host();
		$data 		= array();

		$APP_DIR = "/";
		if (strpos(APP_DIR,".") === false)
		{ 
			if (strlen(APP_DIR)>1)
			{
				$APP_DIR = "/" . APP_DIR ."/";
			}
		}	
		
		$WWWROOT 	= Configure::read('connector.WWWROOT');
		$HOST 		= Configure::read('connector.HOST');
		$APPDIR		= Configure::read('connector.APPDIR');

		$data[0]['xhibit_server_id']					= $_SERVER['HOSTNAME'];
		$data[0]['xhibit_server_platform']				= $platform;
		$data[0]['xhibit_server_ip']					= $_SERVER['SERVER_ADDR'];
		$data[0]['xhibit_server_name']					= $hostname;
		$data[0]['xhibit_base_url']						= "http://".$hostname.$APP_DIR;
		$data[0]['xhibit_sessioncheck_url']				= "http://".$hostname.$APP_DIR."checksession/";	
		$data[0]['xhibit_photo_upload_url']				= "http://".$hostname.$APP_DIR."softwares/upload_file";

		if ($html == 'json')
		{
			$data[0]['xhibit_photo_upload_url']				= "http://".$hostname.$APP_DIR."softwares/upload_file_html";
		}
		$data[0]['xhibit_preview_upload_url']			= "http://".$hostname.$APP_DIR."softwares/upload_preview";
		$data[0]['xhibit_cover_upload_url']				= "http://".$hostname.$APP_DIR."softwares/upload_cover";
		$data[0]['xhibit_upload_theme_url']				= "http://".$hostname.$APP_DIR."softwares/upload_theme";			
		$data[0]['xhibit_shoppingcart_url']				= $HOST.$APPDIR."xhibitshop/shop/add/";

		
		$data[0]['xhibit_site_url']						= $HOST.$APPDIR;		
		$data[0]['xhibit_sessioncheck_url']				= $HOST.$APPDIR."users/desktop_login/";	
		$data[0]['xhibit_register_url']					= $HOST.$APPDIR."users/desktop_register/";				
		
		if ($html)
		{
			$_platform = $this->Session->read('platform');
			$data[0]['platform'] 							= $_platform;			
			if ($html == 'json')
			{
				$this->response->type('json');
				$this->response->body(json_encode($data));
			} 
			else
			{
				$dataCollection = $this->TestArrayCollection($data,'User');		
				$this->set(compact('dataCollection'));
				$this->layout = 'empty';
				$this->render('debug');
			}
		}
		else
		{
			//$dataCollection = new ArrayCollection($data,'User');
			$dataCollection = new ArrayCollection($data);		
			return $dataCollection;			
		}		
		
		return 'Send failed';
	}
	
	
	/**
	*       api_get_orderpdfs
	*
	*       Returns all items based on given model
	*
	*       @return         ArrayCollection
	**/		
	public function api_get_orderpdfs($status='start', $html = false)
	{
			$this->LoadModel('OrderPdf');
			$this->ModelName = $this->OrderPdf;
			if (empty($this->ModelName->displayField))
			{
				 $this->ModelName->displayField = 'name';
			}
			
			$options = array('order' => $this->ModelName->alias . '.' . $this->ModelName->displayField . ' ASC');

			if ($status)
			{
				$options['conditions'] = array($this->ModelName->alias . '.status' => $status);
			}			
			
			$data = $this->ModelName->find('all', $options);
			
			if ($html)
			{
				debug($data);	
			}
			else
			{
				$dataCollection = new ArrayCollection($data);		
				return $dataCollection;		
			}
			
	}
	
	/**
	*       api_edit_orderpdfs
	*
	*       Returns all items based on given model
	*
	*       @return         ArrayCollection
	**/		
	public function api_edit_orderpdfs($id = false, $status = 'error', $html = false)
	{
		$this->LoadModel('OrderPdf');
		$this->ModelName = $this->OrderPdf;

		$data = array();
		if ($id)
		{
		
			$this->ModelName->id = $id;
			$data['OrderPdf']['status'] = $status;
			$this->ModelName->save($data);
			$options['conditions'] = array($this->ModelName->alias . '.' . $this->ModelName->primaryKey => $id);				
		
			$data = $this->ModelName->find('all', $options);
			
		}
		
		if ($html)
		{
			debug($data);	
		}
		else
		{
			$dataCollection = new ArrayCollection($data);		
			return $dataCollection;		
		}
			
	}	
	
	
	// -------------------------------------------------------------------
	/**
	*       api_getPrinterProductById
	*
	*       Returns a PrinterProduct by id.
	*
	*       @param			id		int			null	
	*       @return         ArrayCollection
	**/	
	function api_getProductById( $id = null, $html = false )
	{
	
		$this->loadModel('Product');
		$this->loadModel('PrinterProduct');	
		if (isset($id))
		{
			$product_data['UserProduct']	= array();
			$_product_data					= $this->Product->read(null,$id);

			foreach($_product_data as $key=>$value)
			{
				if ($key == 'Product')
				{
					$product_data['Product'] = $value;
				}
				else
				{
					$product_data['Product'][$key] = $value;
				}
			}
			$product_data['User']	= array();
			$this->PrinterProduct->recursive = 2;
			$printer_product_data 	=	$this->PrinterProduct->find('all', array(
												'conditions' => array(
													"PrinterProduct.product_id" => $id,
													"PrinterProduct.product_cover_id" => $product_data['Product']['product_cover_id'],													
												),
												'contain' => array(
													'Printer',
													'PrinterProductPrice',
													'PrinterProductSpine'
												),
											)
										);
			/*
			DIT STAAT TIJDELIJK UIT!
			if ($this->Auth->loggedIn())
			{
				$user = $this->User->read(null,$data[$model]['user_id']);
				$product_data['User'] = $user['User'];
			}
			*/
			$data[0] = array_merge($product_data,$printer_product_data);
			if ($html)
			{
				if ($html == 'json')
				{
					$this->response->type('json');
					$this->response->body(json_encode($data));
				} 
				else
				{
					debug($data);
					$retdata 	= array_merge($printer_product_data);
					
					if ($html == 'export')
					{
						Configure::write('debug', 0);
						$_serialize = 'retdata';
						$_header 	= $_extract = array();

						$_header[] 	= 'Product id';
						$_extract[] = 'Product.id';
						$_header[] 	= 'Product name';
						$_extract[] = 'Product.name';	
						
						$_header[] 	= 'Printer name';								
						$_extract[] = 'Printer.name';					
						
						$_header[] 	= 'XML id';
						$_extract[] = 'PrinterProduct.id';	
						$_header[] 	= 'XML name';
						$_extract[] = 'PrinterProduct.xml_name';											
						$_header[] 	= 'Including cover';
						$_extract[] = 'Product.cover';					
						$_header[] 	= 'Including bookblock';
						$_extract[] = 'Product.bblock';
						$_header[] 	= 'Min. pages';
						$_extract[] = 'Product.min_page';					
						$_header[] 	= 'Max. pages';				
						$_extract[] = 'Product.max_page';					
						$_header[] 	= 'Stepsize';					
						$_extract[] = 'Product.stepsize';
						$_header[] 	= 'Page Width';
						$_extract[] = 'Product.page_width';
						$_header[] 	= 'Page Height';
						$_extract[] = 'Product.page_height';					
						$_header[] 	= 'Page Bleed';
						$_extract[] = 'Product.page_bleed';
						
						$_header[] 	= 'Paperweight';								
						$_extract[] = 'Product.ProductPaperweight.name';
						$_header[] 	= 'Papertype';								
						$_extract[] = 'Product.ProductPapertype.name';
						
						
						$_header[] 	= 'Cover width';								
						$_extract[] = 'ProductCover.width';					
						$_header[] 	= 'Cover height';								
						$_extract[] = 'ProductCover.height';					
						$_header[] 	= 'Cover bleed';								
						$_extract[] = 'ProductCover.bleed';					
						$_header[] 	= 'Cover wrap';								
						$_extract[] = 'ProductCover.wrap';	
						
						$_header[] 	= 'Cover Paperweight';								
						$_extract[] = 'ProductCover.ProductPaperweight.name';
						$_header[] 	= 'Cover Papertype';								
						$_extract[] = 'ProductCover.ProductPapertype.name';
						
						$_header[] 	= 'Cover hardbound';								
						$_extract[] = 'PrinterProductCover.hardbound';
						$_header[] 	= 'Cover hardbound type';								
						$_extract[] = 'PrinterProductCover.hardbound_type';
						$_header[] 	= 'Cover headbandcolor';								
						$_extract[] = 'PrinterProductCover.headbandcolor';
						$_header[] 	= 'Cover endpapercolor';								
						$_extract[] = 'PrinterProductCover.endpapercolor';
						$_header[] 	= 'Cover spineform';								
						$_extract[] = 'PrinterProductCover.spineform';
						$_header[] 	= 'Cover laminate';								
						$_extract[] = 'PrinterProductCover.laminate';																									

						//$pdf_engine_details[$my_sku]['data']['ProductPaperweight']['name'] . ' ' . $pdf_engine_details[$my_sku]['data']['ProductPapertype']['name']
						
						$this->autoRender = true;
						$this->response->download('my_file.csv'); // <= setting the file name				
						$this->viewClass = 'CsvView.Csv';
						$this->set(compact('retdata', '_serialize', '_header', '_extract'));
					}
					else
					{
						debug($retdata);
					}
				}
			}
			else
			{
				$dataCollection = new ArrayCollection($data);	
				return $dataCollection;			
			}
		}
	}

	
	// -------------------------------------------------------------------
	/**
	*       api_getUserProductById
	*
	*       Returns a PrinterProduct by id.
	*
	*       @param			id		int			null	
	*       @return         ArrayCollection
	**/	
	function api_getUserProductsByUserId( $id = null, $platform = 'new', $html = false )
	{
	
		//$this->loadModel('PrinterProduct');	
		//$this->loadModel('UserProduct');	
		$this->loadModel('DocumentManager.Document');	
		$this->Document->recursive = -1;
		$data = array('no id given!');
		if (isset($id))
		{
			$UserProductdata		=	$this->Document->find('all', 
																	array(
																		'conditions' => array(
																			"Document.user_id" => $id,
																			"Document.platform" => $platform,																			
																		),
																		'order' => array(
																			'Document.created DESC'
																		)
																	)
																);

			$data = $UserProductdata;//array(Hash::filter(Hash::combine($UserProductdata, '{n}.UserProduct.id', '{n}.UserProduct.photo_xml')));
			
			if ($html)
			{
				debug($data);
			}
			else
			{
				$dataCollection = new ArrayCollection($data);	
				return $dataCollection;			
			}
		}
	}	
	
	// -------------------------------------------------------------------
		
	// -------------------------------------------------------------------
	/**
	*       api_getUserProductById
	*
	*       Returns a PrinterProduct by id.
	*
	*       @param			id		int			null	
	*       @return         ArrayCollection
	**/	
	function api_getUserProductById( $id = null, $html = false )
	{
	
		$this->loadModel('PrinterProduct');	
		$this->loadModel('UserProduct');	
		$this->UserProduct->recursive = 2;
		
		if (isset($id))
		{
			$user_product_data		=	$this->UserProduct->find('first', array('conditions' => array("UserProduct.id" => $id)));
			$product_id 			=	$user_product_data['UserProduct']['product_id'];
			$printer_product_data 	=	$this->PrinterProduct->find('all', array(
												'conditions' => array(
													"PrinterProduct.product_id" => $product_id
												),
												'contain' => array(
													'Printer',
													'PrinterProductPrice',
													'PrinterProductSpine',													
												)
											)
										);
	
			$data[0] = array_merge($user_product_data,$printer_product_data);
			
			if ($html)
			{
				debug($data);
			}
			else
			{
				$dataCollection = new ArrayCollection($data);	
				return $dataCollection;			
			}
		}
	}	

	// -------------------------------------------------------------------
	/**
	*       api_getUserProductById
	*
	*       Returns a PrinterProduct by id.
	*
	*       @param			id		int			null	
	*       @return         ArrayCollection
	**/	
	function api_getThemeProductById( $id = null, $html = false )
	{
	
		$this->loadModel('PrinterProduct');	
		$this->loadModel('Theme');	
		$this->Theme->recursive = 2;
		
		if (isset($id))
		{
			$user_product_data		=	$this->Theme->find('first', array('conditions' => array("Theme.id" => $id)));
			$product_id 			=	$user_product_data['Theme']['product_id'];
			$printer_product_data 	=	$this->PrinterProduct->find('all', array(
												'conditions' => array(
													"PrinterProduct.product_id" => $product_id
												),
												'contain' => array(
													'Printer',
													'PrinterProductPrice',
													'PrinterProductSpine',													
												)
											)
										);
	
			$data[0] = array_merge($user_product_data,$printer_product_data);
			
			if ($html)
			{
				debug($data);
			}
			else
			{
				$dataCollection = new ArrayCollection($data);	
				return $dataCollection;			
			}
		}
	}	
	
	
	// -------------------------------------------------------------------


	/**
	*       api_saveUserProduct
	*
	*       Saves a UserProduct. Saves POST if no key is given!
	*
	*       @param			id		int			null
	*       @param			key		string			null
	*       @param			value	string			null
	*       @return         ArrayCollection
	**/	

	function api_saveThemeProductById($id = null, $key = null, $value = null, $html = false, $model = 'Theme') {
		$data = $this->api_saveUserProductById($id, $key, $value, 'return', $model);
		$dataCollection = new ArrayCollection(array($data[$model]));		
		return $dataCollection;
	}
	/**
	*       api_saveUserProduct
	*
	*       Saves a UserProduct. Saves POST if no key is given!
	*
	*       @param			id		int			null
	*       @param			key		string			null
	*       @param			value	string			null
	*       @return         ArrayCollection
	**/	

	function api_saveUserProductById($id = null, $key = null, $value = null, $html = false, $model = 'UserProduct') {
		
		
		if (isset($this->request->params['ext']))
		{
			$html = $this->request->params['ext'];
		}

		$this->LoadModel($model);
		$this->ModelName = $this->{$model};

		if (empty($this->request->data))
		{
			if (!empty($key))
			{
				if (is_array($key))
				{
					$this->request->data[$model] = array_combine($key,$value);
				} 
				else
				{
					$this->request->data[$model][$key] = $value;
				}
			}	
		}
		
		if (isset($_FILES['Filedata']))
		{
			$data[$model]['hires'] = $_FILES['Filedata'];
			$fileData = $_FILES['Filedata'];
			unset($_FILES['Filedata']);
			foreach($fileData as $key=>$value)
			{
				$_FILES['data'][$key][$model]['hires'] = $value;	
			}
		}
				
		
		if (!$this->ModelName->exists($id))
		{
			$this->ModelName->create();
			unset($this->ModelName->id);
			if (empty($this->request->data['platform']))
			{
				if (empty($this->request->data[$model]['platform']))
				{
					$this->request->data[$model]['platform'] = 'unknown/not provided';
				}			
			}
			/*
			$data[$model]['id'] 	= $id;
			$data[$model]['msg'] 	= __('Invalid '.$model.' id');
			$data[$model]['result']	= -1;
			*/
		}
		else
		{
			$this->ModelName->id = $id;	
		}

		$update_data = $this->request->data;			

		if ($this->request->data) {
			$data[$model]['data'] 	= $this->request->data;		
			if ($this->ModelName->save($this->request->data)) {
				$data[$model]['id'] 	= $this->ModelName->id;
				$data[$model]['msg'] 	= __('The '.$model.' has been saved');
				$data[$model]['result']	= 'OK';
				$data[$model]['data']	= $this->request->data;
			} else {
				$data[$model]['id'] 	= $this->ModelName->id;
				$data[$model]['msg'] 	= __('The '.$model.'  could not be saved. Please, try again.');
				$data[$model]['result']	= -1;
				$data[$model]['error']	= $this->ModelName->validationErrors;
				$data[$model]['data']	= $this->request->data;
			}
		} else {
			$data[$model]['id'] 	= $this->ModelName->id;
			$data[$model]['msg'] 	= __('No post data for '.$model.' with id '.$id.' given.');
			$data[$model]['result']	= -1;	
		}

		
		if ($html)
		{
			if ($html == 'return')
			{
				return $data;
			}
			else if ($html == 'json')
			{
				$this->response->type('json');
				$this->response->body(json_encode($data));
			} 
			else
			{			
				$return = array('gave me to much HTML');
				debug($return);
				debug($data);	
			}
		}
		else
		{
			$dataCollection = new ArrayCollection(array($data[$model]));		
			return $dataCollection;	
		}
		
		/*
		$data	= array();
		
		
		if (!$id && empty($this->data)) {
			$data[$model]['id'] 	= 'null';
			$data[$model]['msg'] 	= __('No id and postdata given for '.$model);		
			$data[$model]['err'] 	= '';
			$data[$model]['result']	= -1;			
		}
		
		if (!empty($key))
		{
			if (is_array($key))
			{
				$userProductData['UserProduct'] = array_combine($key,$value);
			} 
			else
			{
				$userProductData['UserProduct'][$key] = $value;
			}
			
			if (isset($id))
			{
				$userProductData['UserProduct']['id'] = $id;			
			}
		}
		
		if (!empty($userProductData)) {
			
			$this->loadModel('UserProduct');	
			if (!$id) {
				$this->UserProduct->create();
			}			
			if ($this->UserProduct->save($userProductData)) {
				$id 					= $this->UserProduct->id;
				$data[$model]['data']	= $this->UserProduct->read(null, $id);					
				$data[$model]['msg'] 	= __('The '.$model.' has been saved.');		
				$data[$model]['err'] 	= '';
				$data[$model]['result']	= 1;	
			} else {
				$data[$model]['msg'] 	= __('The '.$model.' could not be saved. Please, try again.');		
				$data[$model]['err'] 	= $this->UserProduct->validationErrors;
				$data[$model]['result']	= -1;	
				if (is_array($key))
				{				
					$data[$model]['method'] = 'Key is given as array';				
				}
				else
				{
					$data[$model]['method'] = 'Key is given as string';				
				}
				$data[$model]['data'] = $userProductData;
			}
		}
		unset($userProductData);


		$dataCollection = new ArrayCollection($data);		
		return $dataCollection;	
		*/

	}
					
	
	function api_updateUserDocumentsByField($field_name='guid_folder',$key=null,$value=null,$html=false) {

		$model = 'Document';
		$this->loadModel('DocumentManager.Document');
		$this->loadModel('User');
		App::uses('Folder', 'Utility');
		
		if ($key != 'NULL')
		{
			
			if (empty($this->request->data))
			{
				if (!empty($key))
				{
					if (is_array($key))
					{
						$this->request->data[$model] = array_combine($key,$value);
					} 
					else
					{
						$this->request->data[$model][$key] = $value;
					}
				}
			}
				
			if (!empty($this->request->data[$model]))
			{
				foreach($this->request->data[$model] as $mykey=>$myvalue)
				{
					$data[$model][] = 	array(
									'id'=>$mykey,
									$field_name=>$myvalue
								);
				}
			}
			
			if (isset($data[$model][0]['id']))
			{
				$res = $this->Document->saveAll($data[$model]);
				if ($res)
				{
					$data[$model]['msg'] = __('The '.$model.' has been saved');
					$data[$model]['result']	= 'OK';
				} else {
					$data[$model]['msg'] 	= __('The '.$model.' could not be saved. Please, try again.');		
					$data[$model]['err'] 	= $res;
					$data[$model]['result']	= -1;				
				}			
			}
			else
			{
					$data[$model]['msg'] 	= __('Not data found to save. Please, try again.');		
					$data[$model]['err'] 	= false;	
					$data[$model]['result']	= -2;	
			}
		}
		else
		{
				$data[$model]['msg'] 	= __('Debug test.');		
				$data[$model]['err'] 	= false;	
				$data[$model]['result']	= -2;	
		}			


		
		if ($html)
		{
			$return = array('gave me to much HTML');
			debug($return);
			debug($data);	
		}
		else
		{
			$dataCollection = new ArrayCollection(array($data[$model]));		
			return $dataCollection;	
		}		
		/*$res = $this->Document->saveAll($data);
		if ($res)
		{
			unset($data);
			$data = array();
			$data[$model]['msg'] = __('The '.$model.' has been saved');
			$data[$model]['result']	= 'OK';
		} else {
			$data = array();
			$data[$model]['msg'] 	= __('The '.$model.' could not be saved. Please, try again.');		
			$data[$model]['err'] 	= $this->Document->validationErrors;
			$data[$model]['result']	= -1;				
		}*/
		
	}

	function api_updateUserDocumentsByGuid($key=null,$value=null,$html=false) {
		
		$model 				= 'Document';
		$guid_folder 		= '';
		$name_folder 		= 'Mijn fotoalbum';
		$user_product_id	= -1;
		
		if ($key != 'NULL')
		{

			if (empty($this->request->data))
			{
				if (!empty($key))
				{
					if (is_array($key))
					{
						$this->request->data[$model] = array_combine($key,$value);
					} 
					else
					{
						$this->request->data[$model][$key] = $value;
					}
				}
			}		

			$guid_folder 		= $this->request->data[$model]['guid_folder'];
			$name_folder 		= $this->request->data[$model]['name_folder'];	
			$user_product_id 	= $this->request->data[$model]['user_product_id'];
					
			if ($user_product_id > 0)
			{
				$model					= 'UserProduct';
				$folder_data			= array('guid'=>$guid_folder,'name' =>$name_folder);
				$this->LoadModel($model);
				$save_data				=	array(
												$model => array(
													'id' => $user_product_id,
													'name' => $name_folder,
													'folder_data' => json_encode($folder_data)
												)
											);
				$data['UserProduct']	= $this->UserProduct->save($save_data);
			}
		
			$this->loadModel('DocumentManager.Document');
			$db				= $this->Document->getDataSource();
			$name_folder	= $db->value($name_folder, 'string');
			$res = $this->Document->updateAll(
										array(
											'Document.name_folder' => $name_folder
										),
										array(
											'Document.guid_folder'=>$guid_folder
										)
									);		
			
			if ($res)
			{
				$data[$model]['msg'] = __('The '.$model.'s has been saved');
				$data[$model]['result']	= 'OK';
			}
			else
			{
				$data[$model]['msg'] 	= __('The '.$model.' could not be saved. Please, try again.');		
				$data[$model]['err'] 	= $res;
				$data[$model]['result']	= -1;				
			}
		}
		else
		{
			$data[$model]['msg'] 	= __('Debug test.');		
			$data[$model]['err'] 	= false;	
			$data[$model]['result']	= -2;	
		}			
		
		if ($html)
		{
			$return = array('gave me to much HTML');
			debug($return);
			debug($data);
		}
		else
		{
			$dataCollection = new ArrayCollection(array($data[$model]));		
			return $dataCollection;	
		}
		
	}
	

	/* Simple script to upload a zip file to the webserver and have it unzipped */
	function upload_and_unzip_file($print_return_data = true)
	{
		App::uses('Folder', 'Utility');
		$model = 'ZipUpload';
		$message = "No post data. Please try again.";

		if ($this->request->data) {

			$filename		= 	$this->data['fname'];
			$source			= 	$_FILES['file']['tmp_name'];
			$type			= 	$_FILES['file']['type'];
			$name			= 	explode(".", $filename);
			$accepted_types = 	array(
									'application/zip',
									'application/x-zip-compressed',
									'multipart/x-zip',
									'application/x-compressed'
								);
			
			foreach($accepted_types as $mime_type)
			{
				if($mime_type == $type)
				{
					$okay = true;
					break;
				}
			}
		
			if (strtolower($name[1]) != 'zip')
			{
				$message = "The file you are trying to upload is not a .zip file. Please try again.";
			}
			else
			{
		
				/* PHP current path */
				$path 		= WWW_ROOT.DS.'zipuploads'.DS; // absolute path to the directory where zipper.php is in
				$filenoext	= basename($filename, '.zip'); // absolute path to the directory where zipper.php is in (lowercase)
				$filenoext	= basename($filenoext, '.ZIP'); // absolute path to the directory where zipper.php is in (when uppercase)
				
				$targetdir	= $path . $filenoext; // target directory
				$targetzip	= $path . $filename; // target zip file
			
				/* create directory if not exists', otherwise overwrite */
				/* target directory is same as filename without extension */
				
				$folder = new Folder($targetdir, true, 0777);
				
				/* here it is really happening */
				$message = "There was a problem with the upload. Please try again.";
				if(move_uploaded_file($source, $targetzip))
				{
					$zip	= new ZipArchive();
					$x		= $zip->open($targetzip); // open the zip file to extract
					if ($x === true)
					{
						$zip->extractTo($targetdir); // place in the directory with same name
						$zip->close();
						//unlink($targetzip);
					}
					$message = "Your .zip file was uploaded and unpacked.";
					echo $message;
					echo '';
					die(json_encode($folder->findRecursive()));
					
				}
			}

			die($message);
		}	
		else
		{
			$this->autoRender = true;
		}

	}
	
	function upload_file($print_return_data = true) {

		$html = false;
		$model = 'Document';
		$this->loadModel('DocumentManager.Document');
		$this->loadModel('User');
		App::uses('Folder', 'Utility');

		$data[$model]['id'] 	= false;
		$data[$model]['msg'] = __('Initial data');	
		$data[$model]['err'] 	= $this->request;							
		$data[$model]['result']	= -1;			
		
		$headers = '';
		if (!function_exists('getallheaders'))
		{
			foreach ($_SERVER as $name => $value)
			{
				if (substr($name, 0, 5) == 'HTTP_')
				{
					$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
				}
			}
		} 	
		else
		{
			$headers = getallheaders();	
		}		

		if ($this->request->data) {
			foreach ($this->data as $key=>$value)
			{
				$data[$model][$key] = $value;
			}

			if (isset($_FILES['Filedata']))
			{
				$data[$model][$this->Document->fileFieldName] = $_FILES['Filedata'];
				$fileData = $_FILES['Filedata'];
				
				unset($_FILES['Filedata']);
				foreach($fileData as $key=>$value)
				{
					$_FILES['data'][$key][$model]['hires'] = $value;	
				}
			}
			
			$user_id = $data[$model]['user_id'];
			if (!isset($data[$model]['platform']))
			{
				$data[$model]['platform'] = 'cms';
			}
			$platform = $data[$model]['platform'];			
			/*
			DIT STAAT TIJDELIJK UIT!!!!  IVM NIET UNIEKE USERIDS
			if (!$this->Auth->loggedIn())
			{
				$user = $this->User->read(null,$data[$model]['user_id']);
				if (isset($user['User']['id']))
				{
					$this->Auth->login($user['User']);
					if (!$this->Auth->loggedIn())
					{						
						$data[$model]['id'] 	= -1;
						$data[$model]['msg'] = __('Not valid login');								
						$data[$model]['result']	= -1;			
						echo json_encode($data[$model]);
						die();
					}
				}
			}
			else
			{
				$user_id = $this->Session->read('Auth.User.id');	
			}		
			*/			
			$dir_array													= explode("/",$data[$model]['dir_array']);
			$data[$model]['fileName']									= $this->Document->getNextUniqueFilename($dir_array, $this->Document->getFlexFilename($data[$model]['fileName']));
			$data[$model]['Filename']									= $data[$model]['fileName'];
			$data[$model]['hires']['name']								= $data[$model]['fileName'];
			$data[$model]['dir']										= implode("/",$dir_array);
			$data[$model]['url']										= $this->Document->getRelativePath($dir_array, $data[$model]['fileName']);
			if (isset($data[$model]['guid_folder']))
			{			
				$data[$model]['guid_folder']								= $data[$model]['guid_folder'];
			}
			if (isset($data[$model]['exif_info']))
			{
				$data[$model]['exif_info']									= $data[$model]['exif_info'];
			}
			if (isset($data[$model]['name_folder']))
			{
				$data[$model]['name_folder']								= $data[$model]['name_folder'];
			}
			
			
			
			if (!is_dir($this->Document->getFullPath($dir_array))) {
				$folder = new Folder($this->Document->getFullPath($dir_array), true);
			}			
			$this->Document->uploadSettings($this->Document->fileFieldName, 'path', $this->Document->getFullPath($dir_array).DS);
			$this->Document->uploadSettings($this->Document->fileFieldName, 'thumbnailPath', $this->Document->getFullPath($dir_array).DS);
			
			$res = $this->Document->save($data);
			
			if (strpos($data[$model]['hires']['name'],"maareenerror") > 0)
			{
				$res = false;
			}
			
			if ($res)
			{
				unset($data);
				$data = $this->Document->read(null,$this->Document->id);
				$data[$model]['msg'] = __('The '.$model.' has been saved');
				$data[$model]['result']	= 'OK';
			} else {
				$data[$model]['id'] 	= $this->Document->id;
				$data[$model]['msg'] 	= __('The '.$model.' could not be saved. Please, try again.');		
				$data[$model]['err'] 	= $this->Document->validationErrors;
				$data[$model]['result']	= -1;				
			}
		}
		else
		{
			$data[$model]['id'] 	= $this->Document->id;
			$data[$model]['msg'] = __('Invalid post data');	
			$data[$model]['err'] 	= $this->request->is('post');							
			$data[$model]['result']	= -1;			
		}			

		
		if ($print_return_data)
		{
			echo json_encode($data[$model]);
			die();
		}
		
		return $data;

	}
	
	function upload_file_html() {
		
		Configure::write('debug', 0);
		try {		
			$model = 'Document';
			$this->loadModel('DocumentManager.Document');
			App::uses('Folder', 'Utility');
			
			$data[$model]['id'] 	= false;
			$data[$model]['msg'] = __('Initial data');	
			$data[$model]['err'] 	= $this->request;							
			$data[$model]['result']	= -1;	
					
	
			if ($this->request->data) 
			{
				// read all received data
				foreach (json_decode($this->data) as $key=>$value)
				{
					$data[$model][$key] = $value;
				}
				
				if (isset($data[$model]['dbid']) && ($data[$model]['dbid'] > 0))
				{
					$this->Document->id = $data[$model]['dbid'];
					$this->Document->recursive = -1;
					$data = $this->Document->read(null,$this->Document->id);
					$files = array();
					$files[] = $data['Document']['full_path'].$data['Document']['hires'];
					$files[] = $data['Document']['full_path'].$data['Document']['lowres'];
					$files[] = $data['Document']['full_path'].$data['Document']['thumb'];	
					$data[$model]['msg'] = __('The '.$model.' has been checked');
					$data[$model]['result']	= 'OK';
					$data[$model]['data'] 	= $files;
					$data[$model]['debug'] 	= false;					
				}
				else
				{
					
					if (strpos($_FILES['file']['name'],"maareenerror") > 0)
					{
						throw new Exception('Filename consists of maareenerror');	
					}
										
					// read image
					if (isset($_FILES['file']))
					{
						$data[$model][$this->Document->fileFieldName] = $_FILES['file'];
						$fileData = $_FILES['file'];
					}
					
					$user_id = $data[$model]['user_id'];
					
					// check if platform is set
					if (!isset($data[$model]['platform']))
					{
						$data[$model]['platform'] = 'cms';
					}
					
					$mirrorit = false;
					$rotateit = false;
					if (isset($data[$model]['mirrorit']))
					{
						if ($data[$model]['mirrorit'])
						{
							$mirrorit = $data[$model]['mirrorit'];
						}
						unset($data[$model]['mirrorit']);
					}								
					if (isset($data[$model]['rotateit']))
					{
						if ($data[$model]['rotateit'] != 0)
						{
							$rotateit = $data[$model]['rotateit'];
						}
						unset($data[$model]['rotateit']);
					}
							
					$platform = $data[$model]['platform'];	
					
					if ($data[$model]['hires']['name'] == 'blob')
					{
						switch ($data[$model]['hires']['type'])
						{
							case 'image/jpeg':
							case 'image/jpg':
								$ext = 'jpg';
							break;
							
							case 'image/png':
								$ext = 'png';
							break;

							case 'image/gif':
								$ext = 'gif';
							break;															
							
							default:
								$ext = 'jpg';
							break;	
						}
						$data[$model]['hires']['name'] = $data[$model]['guid'].'.'.$ext;
					}

					
					$dir_array						= explode("/",$data[$model]['dir_array']);
					$data[$model]['dir']			= $data[$model]['dir_array'];
					$data[$model]['hires']['name']  = $this->Document->rename_extension($data[$model]['hires']['name']);
					$data[$model]['fileName']		= $this->Document->getNextUniqueFilename($dir_array, $data[$model]['hires']['name']);
					$data[$model]['Filename']		= $data[$model]['fileName'];
					$data[$model]['hires']['name']	= $data[$model]['fileName'];
					$data[$model]['url']			= $this->Document->getRelativePath($dir_array, $data[$model]['fileName']);
					
					
					if (isset($data[$model]['guid_folder']))
					{			
						$data[$model]['guid_folder'] = $data[$model]['guid_folder'];
					}
					if (isset($data[$model]['exif_info']))
					{
						$data[$model]['exif_info'] = str_replace('<?XML:NAMESPACE PREFIX = "PUBLIC" NS = "URN:COMPONENT" />',"",$data[$model]['exif_info']);
					}
					if (isset($data[$model]['name_folder']))
					{
						$data[$model]['name_folder'] = $data[$model]['name_folder'];
					}
					
					if (!is_dir($this->Document->getFullPath($dir_array))) {
						$folder = new Folder($this->Document->getFullPath($dir_array), true);
					}			
		
					$this->Document->uploadSettings($this->Document->fileFieldName, 'path', $this->Document->getFullPath($dir_array).DS);
					$this->Document->uploadSettings($this->Document->fileFieldName, 'thumbnailPath', $this->Document->getFullPath($dir_array).DS);
		
					$res = $this->Document->save($data);
					if ($res)
					{
						unset($data);
						$this->Document->recursive = -1;
						$data = $this->Document->read(null,$this->Document->id);
						
						
						$files = array();
						$files[] = $data['Document']['full_path'].$data['Document']['hires'];
						$files[] = $data['Document']['full_path'].$data['Document']['lowres'];
						$files[] = $data['Document']['full_path'].$data['Document']['thumb'];	
							
	
						if ( ($mirrorit) || ($rotateit) )
						{
							$image   = new imagick();
							$i = 0;
							foreach($files as $file)
							{
								$resultFile[$i] = array('file'=>$file);
								if ($image->readImage($file))
								{
									$resultFile[$i]['mirror_action'] = $mirrorit;
									if ($mirrorit == 'flip')
									{
										$resultFile[$i]['mirror_result'] = $image->flipImage();
									}
									if ($mirrorit == 'flop')
									{
										$resultFile[$i]['mirror_result'] = $image->flopImage();
									}
									$resultFile[$i]['rotate_action'] = $rotateit;
									if ($rotateit != 0)
									{
										$resultFile[$i]['rotate_result'] = $image->rotateImage(new ImagickPixel('none'), $rotateit); 
									}
									$resultFile[$i]['write_result'] = $image->writeImage($file);
									$image->clear(); 
								}
								$i++;
							}
							$image->destroy();
						}
						
						
						$data[$model]['msg'] = __('The '.$model.' has been saved');
						$data[$model]['result']	= 'OK';
						$data[$model]['data'] 	= $files;
						$data[$model]['debug'] 	= $resultFile;

					} else {
						$data[$model]['id'] 	= -1;
						$data[$model]['msg'] 	= __('The '.$model.' could not be saved. Please, try again.');		
						$data[$model]['err'] 	= $this->Document->validationErrors;
						$data[$model]['data'] 	= $this->request->data;
						$data[$model]['result']	= -1;				
					}

				}
				
			}
			else
			{
				$data[$model]['id'] 	= $this->Document->id;
				$data[$model]['msg']	= __('Invalid post data');	
				$data[$model]['err'] 	= 'No post data available (isPost: '.$this->request->is('post').')';							
				$data[$model]['result']	= -1;			
			}
		} catch (Exception $e) {
			
			$data[$model]['id'] 	= false;
			$data[$model]['msg'] 	= __('Try/Catch error');
			$data[$model]['err'] 	= $e->getMessage();							
			$data[$model]['result']	= -1;			
		}

		$this->response->type('json');
		$this->response->body(json_encode($data));   
	}

	function upload_file_proxy() {
		Configure::write('debug', 2);

		$model = 'Document';
		$this->loadModel('DocumentManager.Document');
		App::uses('Folder', 'Utility');
		
		$data[$model]['id'] 	= false;
		$data[$model]['msg'] = __('Initial data');	
		$data[$model]['err'] 	= $this->request;							
		$data[$model]['result']	= -1;	
                

		if ($this->request->data) 
        {
                     // read all received data
			foreach (json_decode($this->data) as $key=>$value)
			{
				$data[$model][$key] = $value;
			}
                        // read image
			if (isset($_FILES['file']))
			{
				$data[$model][$this->Document->fileFieldName] = $_FILES['file'];
				$fileData = $_FILES['file'];
			}
			
			$user_id = $data[$model]['user_id'];
                        
                        // check if platform is set
			if (!isset($data[$model]['platform']))
			{
				$data[$model]['platform'] = 'cms';
			}
                        
			$platform = $data[$model]['platform'];	
         				
			$dir_array						= explode("/",$data[$model]['dir_array']);
			$data[$model]['dir']			= $data[$model]['dir_array'];
			$data[$model]['fileName']		= $this->Document->getNextUniqueFilename($dir_array, $data[$model]['hires']['name']);
			$data[$model]['Filename']		= $data[$model]['fileName'];
			$data[$model]['hires']['name']	= $data[$model]['fileName'];
			$data[$model]['url']			= $this->Document->getRelativePath($dir_array, $data[$model]['fileName']);
			
			if (isset($data[$model]['guid_folder']))
			{			
				$data[$model]['guid_folder'] = $data[$model]['guid_folder'];
			}
			if (isset($data[$model]['exif_info']))
			{
				$data[$model]['exif_info'] = $data[$model]['exif_info'];
			}
			if (isset($data[$model]['name_folder']))
			{
				$data[$model]['name_folder'] = $data[$model]['name_folder'];
			}
			
			if (!is_dir($this->Document->getFullPath($dir_array))) {
				$folder = new Folder($this->Document->getFullPath($dir_array), true);
			}			
			$this->Document->uploadSettings($this->Document->fileFieldName, 'path', $this->Document->getFullPath($dir_array).DS);
			$this->Document->uploadSettings($this->Document->fileFieldName, 'thumbnailPath', $this->Document->getFullPath($dir_array).DS);
			
			$res = $this->Document->save($data);
			if ($res)
			{
				unset($data);
				$this->Document->recursive = -1;
				$data = $this->Document->read(null,$this->Document->id);
				$data[$model]['msg'] = __('The '.$model.' has been saved');
				$data[$model]['result']	= 'OK';
			} else {
				$data[$model]['id'] 	= $this->Document->id;
				$data[$model]['msg'] 	= __('The '.$model.' could not be saved. Please, try again.');		
				$data[$model]['err'] 	= $this->Document->validationErrors;
				$data[$model]['data'] 	= $this->request->data;
				$data[$model]['result']	= -1;				
			}
		}
		else
		{
			$data[$model]['id'] 	= $this->Document->id;
			$data[$model]['msg'] = __('Invalid post data');	
			$data[$model]['err'] 	= $this->request->is('post');							
			$data[$model]['result']	= -1;			
		}

		$this->response->type('json');
		$this->response->body(json_encode($data));   
	}


	function upload_preview($userproductID = null, $file_name = 'cover.png') {
		//Checking for formdata by form
		if (!empty($this->data))
		{
			$form_data = $this->data;
		}

		if (isset($this->params['form']['userproductID']))
		{
			$form_data['id']	= $this->params['form']['userproductID'];
		}
		
		if (isset($this->params['form']['fileData']))
		{
			$form_data['fileData']	= $this->params['form']['fileData'];
		}
		
		if (isset($this->params['form']['fileName']))
		{
			$form_data['file_name']	= $this->params['form']['fileName'];
		}
		
		$sResult = "RES: Geen data!";
		//Checking for formdata
		if (!empty($form_data)) {
			if (!empty($form_data['id']))
			{
				$user_product_id = $form_data['id'];
			}
			if (!empty($form_data['userproductID']))
			{
				$form_data['id'] 		= $form_data['userproductID'];
				$user_product_id 		= $form_data['userproductID'];
				$form_data['directory'] = $form_data['userproductID'];
			}			
		
			if (!empty($form_data['fileData']))
			{
				$fileData 		= $form_data['fileData'];
			}	
		
			if (!empty($form_data['fileName']))
			{
				$file_name 				= $form_data['fileName'];
				$form_data['file_name'] = $form_data['fileName'];
			}
			if (!empty($form_data['platform']))
			{
				$platform 		= $form_data['platform'];
			}				
		
			//Setting some Uploader variables
			$this->Folder 	= new Folder();
			
			$WWWROOT = '/data/XHIBIT/www.xhibit.com/';
			if (isset($platform))
			{
				switch ($platform)
				{
					case 'www':
						$WWWROOT = '/data/XHIBIT/www.xhibit.com/';	
					break;
					
					case 'beta':
						$WWWROOT = '/data/XHIBIT/beta.xhibit.com/staging';		
					break;
					
					case 'new':
					case 'fenf':
					case 'hampshire':
					case 'cms':
					case 'bonusboek':
					case 'enjoy':
					default:
						$WWWROOT = '/data/XHIBIT/api.xhibit.com/v2/files';	
					break;			
				}			
				
			}
			
			
			$_upload_dir 	= $this->Folder->slashTerm(str_replace("//","/",$WWWROOT.'/coveruploads/'.$user_product_id));
			
			//Create a folder
			$created = $this->Folder->create($_upload_dir); 
			
			
			//Start uploading
			$sResult = "RES: Niet geuploaded!";
			$upload__filename = $_upload_dir.$file_name;
			$fp = fopen($upload__filename, 'wb+');
			if (fwrite($fp, base64_decode($fileData)))
			{
				$sResult = $user_product_id . ';coveruploads/'.$file_name.';'.$upload__filename;
			}
			fclose($fp);
		}
		
		die($sResult);
	} 

	function upload_cover($userproductID = null, $file_name = 'cover.png') {
		//Checking for formdata by form
		if (!empty($this->data))
		{
			$form_data = $this->data;
		}

		if (isset($this->params['form']['userproductID']))
		{
			$form_data['id']	= $this->params['form']['userproductID'];
		}
		
		if (isset($this->params['form']['fileData']))
		{
			$form_data['fileData']	= $this->params['form']['fileData'];
		}
		
		if (isset($this->params['form']['fileName']))
		{
			$form_data['file_name']	= $this->params['form']['fileName'];
		}
		
		$sResult = "RES: Geen data!";
		//Checking for formdata
		if (!empty($form_data)) {
			if (!empty($form_data['id']))
			{
				$user_product_id = $form_data['id'];
			}
			if (!empty($form_data['userproductID']))
			{
				$form_data['id'] 		= $form_data['userproductID'];
				$user_product_id 		= $form_data['userproductID'];
				$form_data['directory'] = $form_data['userproductID'];
			}			
		
			if (!empty($form_data['fileData']))
			{
				$fileData 		= $form_data['fileData'];
			}	
		
			if (!empty($form_data['fileName']))
			{
				$file_name 				= $form_data['fileName'];
				$form_data['file_name'] = $form_data['fileName'];
			}
			if (!empty($form_data['platform']))
			{
				$platform 		= $form_data['platform'];
			}				
		
			//Setting some Uploader variables
			$this->Folder 	= new Folder();
			
			$WWWROOT = '/data/XHIBIT/www.xhibit.com/';
			if (isset($platform))
			{
				switch ($platform)
				{
					case 'www':
						$WWWROOT = '/data/XHIBIT/www.xhibit.com/';	
					break;
					
					case 'beta':
						$WWWROOT = '/data/XHIBIT/beta.xhibit.com/staging';		
					break;
					
					case 'new':
					case 'fenf':
					case 'hampshire':
					case 'cms':
					case 'bonusboek':
					case 'enjoy':
					default:
						$WWWROOT = '/data/XHIBIT/api.xhibit.com/v2/files';	
					break;			
				}			
				
			}

			
			
			$_upload_dir 	= $this->Folder->slashTerm(str_replace("//","/",$WWWROOT.'/coveruploads/'.$user_product_id));
			
			//Create a folder
			$created = $this->Folder->create($_upload_dir); 
			
			
			//Start uploading
			$sResult = "RES: Niet geuploaded!";
			$upload__filename = $_upload_dir.$file_name;
			$fp = fopen($upload__filename, 'wb+');
			if (fwrite($fp, base64_decode($fileData)))
			{
				$sResult 	= "RES: Geuploaded, maar niet opgeslagen in de database!";
				unset($form_data['fileData']);
				$model	= 'UserProduct';
				$this->LoadModel($model);
				$this->ModelName = $this->{$model};									
				$this->ModelName->id 		= $user_product_id;
				$sResult 					= $this->ModelName->save($form_data);
			}
			fclose($fp);
			
			if (is_array($sResult))
			{
				$sResult = $user_product_id . ';coveruploads/'.$file_name.';'.$upload__filename;
			}
		}
		
		die($sResult);
	} 


	function clean_upload_theme_dir($themeID = null, $platform = 'www') {
				
		
		$WWWROOT = '/data/XHIBIT/www.xhibit.com/';
		if (isset($platform))
		{
			switch ($platform)
			{
				case 'www':
					$WWWROOT = '/data/XHIBIT/www.xhibit.com/';	
				break;
				
				case 'beta':
					$WWWROOT = '/data/XHIBIT/beta.xhibit.com/staging';		
				break;
				
				case 'new':
				case 'fenf':
				case 'hampshire':
				case 'cms':
				case 'bonusboek':
				case 'enjoy':
				default:
					$WWWROOT = '/data/XHIBIT/api.xhibit.com/v2/files';	
				break;			
			}			
			
		}

		
		
		
		$folder = str_replace("//","/",$WWWROOT.'/themeuploads/'.$themeID);
		//Setting some Uploader variables
		$this->Folder 	= new Folder($folder);		
		$files = $this->Folder->find('.*\.jpg');
		foreach ($files as $file) {
			$this->File = new File($this->Folder->pwd() . DS . $file);
			if (substr('/themeuploads/'.$themeID,$this->Folder->pwd()) !== false)
			{
				$deleted[] = $this->File->delete();	
			}
			$this->File->close(); // Be sure to close the file when you're done
		}

		$sResult = $themeID . ';themeuploads/'.$themeID.'/;'.$folder.';skipped';
		if (count($files) == count($deleted))
		{
			$sResult = $themeID . ';themeuploads/'.$themeID.'/;'.$folder.';deleted';
		}
		
		die($sResult);			

	}
	
	function upload_theme($themeID = null, $file_name = 'theme.png') {
		//Checking for formdata by form
		if (!empty($this->data))
		{
			$form_data = $this->data;
		}

		if (isset($this->params['form']['themeID']))
		{
			$form_data['id']	= $this->params['form']['themeID'];
		}
		
		if (isset($this->params['form']['fileData']))
		{
			$form_data['fileData']	= $this->params['form']['fileData'];
		}
		
		if (isset($this->params['form']['fileName']))
		{
			$form_data['file_name']	= $this->params['form']['fileName'];
		}
		
		$sResult = "RES: Geen data!";
		//Checking for formdata
		if (!empty($form_data)) {
			if (!empty($form_data['id']))
			{
				$user_product_id = $form_data['id'];
			}
			if (!empty($form_data['themeID']))
			{
				$form_data['id'] 		= $form_data['themeID'];
				$user_product_id 		= $form_data['themeID'];
				$form_data['directory'] = $form_data['themeID'];
			}			
		
			if (!empty($form_data['fileData']))
			{
				$fileData 		= $form_data['fileData'];
			}	
		
			if (!empty($form_data['fileName']))
			{
				$file_name 				= $form_data['fileName'];
				$form_data['file_name'] = $form_data['fileName'];
			}
			if (!empty($form_data['platform']))
			{
				$platform 		= $form_data['platform'];
			}				
		
			//Setting some Uploader variables
			$this->Folder 	= new Folder();
			
			$WWWROOT = '/data/XHIBIT/www.xhibit.com/';
			if (isset($platform))
			{
				switch ($platform)
				{
					case 'www':
						$WWWROOT = '/data/XHIBIT/www.xhibit.com/';	
					break;
					
					case 'beta':
						$WWWROOT = '/data/XHIBIT/beta.xhibit.com/staging';		
					break;
					
					case 'new':
					case 'fenf':
					case 'hampshire':
					case 'cms':
					case 'bonusboek':
					case 'enjoy':
					default:
						$WWWROOT = '/data/XHIBIT/api.xhibit.com/v2/files';	
					break;			
				}			
				
			}
			
			
			$_upload_dir 	= $this->Folder->slashTerm(str_replace("//","/",$WWWROOT.'/themeuploads/'.$user_product_id));
			
			//Create a folder
			$created = $this->Folder->create($_upload_dir); 
			
			
			//Start uploading
			$sResult = "RES: Niet geuploaded!";
			$upload__filename = $_upload_dir.$file_name;
			$fp = fopen($upload__filename, 'wb+');
			if (fwrite($fp, base64_decode($fileData)))
			{
				$sResult 	= "RES: Geuploaded, maar niet opgeslagen in de database!";
				unset($form_data['fileData']);
				$model	= 'Theme';
				$this->LoadModel($model);
				$this->ModelName = $this->{$model};									
				$this->ModelName->id 		= $user_product_id;
				$sResult 					= $this->ModelName->save($form_data);
			}
			fclose($fp);
			
			if (is_array($sResult))
			{
				$sResult = $user_product_id . ';themeuploads/'.$user_product_id.'/'.$file_name.';'.$upload__filename;
			}
		}
		
		die($sResult);
	} 






















	/* Old VERSION for CMS! */
	// This is depricated (currently handled in the BasicElementsController) */
	
	/***********************************************************************************************************/
	/*                                                  CMS                                                    */
	/***********************************************************************************************************/
	/**
	*       api_getConfig()
	*
	*       Returns all items based on given model
	*
	*       @return         ArrayCollection
	**/	
	/*
	public function api_getConfig()
	{
		$data = array();
		$dataCollection = new ArrayCollection($data);		
		return $dataCollection;		
	}
	*/


	/**
	*       api_get
	*
	*       Returns all items based on given model
	*
	*       @return         ArrayCollection
	**/		
	public function api_get($model,$id=false,$html=false)
	{
		
		if ($id <= 0)
		{
			$id = false;
		}
		
		if ($model == 'Category')
		{
			$this->ModelName = ClassRegistry::init('Categories.Category');
		}
		elseif ($model == 'Tag')
		{
			$this->ModelName = ClassRegistry::init('Tags.Tag');
		}
		else
		{
			$this->LoadModel($model);
			$this->ModelName = $this->{$model};
		}
		
		if (empty($this->ModelName->displayField))
		{
			 $this->ModelName->displayField = 'name';
		}
		
		$options = array('order' => $this->ModelName->alias . '.' . $this->ModelName->displayField . ' ASC', 'recursive'=> 0);
		if ($id)
		{
			$options['conditions'] = array($this->ModelName->alias . '.' . $this->ModelName->primaryKey => $id);
		}	
		if (isset($this->request->params['named']))
		{
			if (!isset($options['conditions']))
			{
				$options['conditions'] = array();
			}
			foreach($this->request->params['named'] as $Nkey=>$Nvalue)
			{
				if (strpos($Nkey,".") === false)
				{
					$options['conditions'][$this->ModelName->alias . '.' . $Nkey] = $Nvalue;
				}
				else
				{
					$options['conditions'][$Nkey] = $Nvalue;
				}
			}
		}

		$data = $this->ModelName->find('all', $options);
		
		if ($html)
		{
			debug($options);
			debug($data);	
			debug($this->request->params['named']);
		}
		else
		{
			$dataCollection = new ArrayCollection($data);		
			return $dataCollection;		
		}
	}
	
	/***********************************************************************************************************/	/**
	*       api_tree
	*
	*       Returns all items based on given model, id in a tree
	*
	*       @return         ArrayCollection
	**/	
	public function api_tree($model,$id = false, $html=false)
	{
		
		if ($model == 'Category')
		{
			$this->ModelName = ClassRegistry::init('Categories.Category');
		}
		elseif ($model == 'Tag')
		{
			$this->ModelName = ClassRegistry::init('Tags.Tag');
		}
		else
		{
			$this->LoadModel($model);
			$this->ModelName = $this->{$model};
		}

		if (empty($this->ModelName->displayField))
		{
			 $this->ModelName->displayField = 'name';
		}

		$options = array('parent' => 'category_id','order' => array($this->ModelName->alias . '.' . $this->ModelName->displayField . ' ASC'));
		if ($id)
		{
			$options['conditions'] = array($this->ModelName->alias .'.' . $this->ModelName->primaryKey => $id);
		}
		$data = $this->ModelName->find('threaded', $options);
		
		if ($html)
		{
			debug($data);	
		}
		else
		{
			$dataCollection = new ArrayCollection($data);		
			return $dataCollection;		
		}
	}		
	
	/***********************************************************************************************************/	/**
	*       api_categorized
	*
	*       Returns all categorized items based on given model and category
	*
	*       @return         ArrayCollection
	**/	
	public function api_categorized($model, $category_id = false, $html=false)
	{
		
		$this->LoadModel('Categories.Categorized');
		
		$options = array(
						'conditions' => array(
							'Categorized.model' => $model,
						)
					);
		if ( ($category_id) && ($category_id != 'false') )
		{
			$options['conditions']['Categorized.category_id'] = $category_id;
		}

		$data = $this->Categorized->find('all', $options);
		
		$model_ids = Set::extract('{n}.Categorized.foreign_key', $data);

		$this->LoadModel($model);
		$this->ModelName = $this->{$model};
		
		if (empty($this->ModelName->displayField))
		{
			 $this->ModelName->displayField = 'name';
		}
		
		$data = $this->ModelName->find('all', array('conditions'=>array('id'=>$model_ids),'order' => $this->ModelName->alias . '.' . $this->ModelName->displayField . ' ASC'));
		
		if ($html)
		{
			debug($data);	
		}
		else
		{
			$dataCollection = new ArrayCollection($data);		
			return $dataCollection;		
		}

	}	

	/***********************************************************************************************************/	/**
	*       api_search
	*
	*       Returns all items based on given model and key, value pair
	*
	*       @return         ArrayCollection
	**/	
	public function api_search($model, $condition_keys=false, $condition_values=false, $html=false)
	{
		
		if ($model == 'Category')
		{
			$this->ModelName = ClassRegistry::init('Categories.Category');
		}
		elseif ($model == 'Tag')
		{
			$this->ModelName = ClassRegistry::init('Tags.Tag');
		}
		else
		{
			$this->LoadModel($model);
			$this->ModelName = $this->{$model};
		}
		
		if (empty($this->ModelName->displayField))
		{
			 $this->ModelName->displayField = 'name';
		}
		
		$options = array('order' => $this->ModelName->alias . '.' . $this->ModelName->displayField . ' ASC');
		if ($condition_keys)
		{
			$options['conditions'] = array_combine($condition_keys,$condition_values);
		}	
		
		$data = $this->ModelName->find('all', $options);
		
		if ($html)
		{
			debug($data);	
		}
		else
		{
			$dataCollection = new ArrayCollection($data);		
			return $dataCollection;		
		}

	}			

	/***********************************************************************************************************/	/**
	*       api_view
	*
	*       Returns all items based on given model
	*
	*       @return         ArrayCollection
	**/	
	public function api_view($model,$id = null,$html=false) {
		
		$this->LoadModel($model);
		
		if (!$this->ModelName->exists($id)) {
			$data[$model]['id'] 	= $id;
			$data[$model]['msg'] = __('Invalid '.$model.' id');
		}
		else
		{
			$options = array('conditions' => array($this->ModelName->alias . '.' . $this->ModelName->primaryKey => $id));
			$data = $this->ModelName->find('first', $options);
		}
		/* RETURNING THE DATA */
		if ($html)
		{
			debug($data);	
		}
		else
		{
			$dataCollection = new ArrayCollection($data);		
			return $dataCollection;		
		}
	}

	/***********************************************************************************************************/	/**
	*       api_add
	*
	*       Adds an item based on given model and key=>value pair
	*
	*       @return         ArrayCollection
	**/	
	public function api_add($model, $key=false, $value=false, $byteArray = false, $categories=false, $html=false) {

		if ($model == 'Category')
		{
			$this->ModelName = ClassRegistry::init('Categories.Category');
		}
		elseif ($model == 'Tag')
		{
			$this->ModelName = ClassRegistry::init('Tags.Tag');
		}
		else
		{
			$this->LoadModel($model);
			$this->ModelName = $this->{$model};
		}

		if (empty($this->request->data))
		{
			$html=false;
			if (!empty($key))
			{
				if (is_array($key))
				{
					$this->request->data = array_combine($key,$value);
				} 
				else
				{
					$this->request->data[$key] = $value;
				}
			}	
		}
		else
		{
			$html=true;	
		}
		if ($this->request->data) {
			foreach ($this->data as $key=>$value)
			{
				$data[$model][$key] = $value;
			}

			if ( ($model != 'Categories') && (isset($data[$model]['categories'])) )
			{
				$categories = explode(",",$this->request->data['categories']);
			}
			
			if (isset($_FILES['Filedata']))
			{
				$data[$model]['hires'] = $_FILES['Filedata'];
				$fileData = $_FILES['Filedata'];
				unset($_FILES['Filedata']);
				foreach($fileData as $key=>$value)
				{
					$_FILES['data'][$key][$model]['hires'] = $value;	
				}
			}
			
			if (isset($data[$model]['id']))
			{
				$this->ModelName->id = $data[$model]['id'];
			}
			else
			{
				$this->ModelName->create();
			}
			
			if ($this->ModelName->save($data)) {
				$id = $this->ModelName->id;
				if ($categories)
				{
					$this->ModelName->Categorized->deleteAll(array(
							'Categorized.foreign_key' => $id,
							'Categorized.model' => $this->ModelName->alias
						)
					);
					foreach($categories as $category_id)
					{
						$this->ModelName->Categorized->create();
						$this->ModelName->Categorized->save(array(
										'id'			=> $this->ModelName->Categorized->id,
										'category_id' 	=> $category_id,
										'foreign_key' 	=> $id,
										'model' 		=> $this->ModelName->alias
									));							
					}
				}	
				
				$data[$model]['id'] 	= $this->ModelName->id;
				$data[$model]['msg'] = __('The '.$model.' has been saved');
				$data[$model]['result']	= 'OK';
			} else {
				$data[$model]['id'] 	= $this->ModelName->id;
				$data[$model]['msg'] 	= __('The '.$model.' could not be saved. Please, try again.');		
				$data[$model]['err'] 	= $this->ModelName->validationErrors;
				$data[$model]['result']	= -1;				
			}
		}
		else
		{
			$data[$model]['id'] 	= $this->ModelName->id;
			$data[$model]['msg'] = __('Invalid post data');								
			$data[$model]['result']	= -1;			
		}

		if ($this->ModelName->validationErrors)
		{
			$html = true;
			if ($this->ModelName->validationErrors['hires'][0])
			{
				die($this->ModelName->validationErrors['hires'][0]);
			}
			
		}
		
		if ($html)
		{
			$return = $data[$model]['result'];
			if ($data[$model]['result'] != 'OK')
			{
				$return = $data[$model]['msg'];	
			}				
			die($return);
		}
		else
		{
			$dataCollection = new ArrayCollection(array($data[$model]));		
			return $dataCollection;				
		}
		
	}

	/***********************************************************************************************************/	/**
	*       api_save
	*
	*       Saves an item based on given model, id and given key=>value pair
	*
	*       @return         ArrayCollection
	**/	
	public function api_save($model, $id = null, $key, $value, $categories=false, $html=false) {
		
		if ($model == 'Category')
		{
			$this->ModelName = ClassRegistry::init('Categories.Category');
		}
		elseif ($model == 'Tag')
		{
			$this->ModelName = ClassRegistry::init('Tags.Tag');
		}
		else
		{
			$this->LoadModel($model);
			$this->ModelName = $this->{$model};
		}

		if (empty($this->request->data))
		{
			if (!empty($key))
			{
				if (is_array($key))
				{
					$this->request->data[$model] = array_combine($key,$value);
				} 
				else
				{
					$this->request->data[$model][$key] = $value;
				}
			}	
		}


		if (isset($this->request->data[$model]['categories']))
		{
			$categories = $this->request->data[$model]['categories'];
		}
		
		if (!$this->ModelName->exists($id))
		{
			$data[$model]['id'] 	= $id;
			$data[$model]['msg'] 	= __('Invalid '.$model.' id');
			$data[$model]['result']	= -1;

		}
		else
		{
			
			$options = array('conditions' => array($this->ModelName->alias . '.' . $this->ModelName->primaryKey => $id));
			$_data = $this->ModelName->find('first', $options);
			$update_data = array_merge($_data,$this->request->data);			

			if ($this->request->data) {
				$this->ModelName->id = $id;
				$data[$model]['data'] 	= $this->request->data;		
				if ($this->ModelName->save($this->request->data)) {
					$data[$model]['id'] 	= $this->ModelName->primaryKey;
					$data[$model]['msg'] 	= __('The '.$model.' has been saved');
					$data[$model]['result']	= 'OK';
					if ($categories)
					{
						if (!is_array($categories))
						{
							if (stristr($categories, ','))
							{
								$categories = explode(',',$categories);
							}
							else
							{
								$categories = array($categories);	
							}
						}
						$this->ModelName->Categorized->deleteAll(array(
								'Categorized.foreign_key' => $id,
								'Categorized.model' => $this->ModelName->alias
							)
						);
						foreach($categories as $i=>$category_id)
						{
							$this->ModelName->Categorized->create();
							$this->ModelName->Categorized->save(array(
											'id'			=> $this->ModelName->Categorized->id,
											'category_id' 	=> $category_id,
											'foreign_key' 	=> $id,
											'model' 		=> $this->ModelName->alias
										));							
						}
					}	
				} else {
					$data[$model]['id'] 	= $this->ModelName->id;
					$data[$model]['msg'] = __('The '.$model.'  could not be saved. Please, try again.');
					$data[$model]['result']	= -1;
				}
			} else {
				$data[$model]['id'] 	= $this->ModelName->id;
				$data[$model]['msg'] 	= __('No post data for '.$model.' with id '.$id.' given.');
				$data[$model]['result']	= -1;	
			}
		}
		
		if ($html)
		{
			$return = array('gave me to much HTML');
			debug($return);
			debug($data);	
		}
		else
		{
			$dataCollection = new ArrayCollection(array($data[$model]));		
			return $dataCollection;	
		}
	}

	/***********************************************************************************************************/	/**
	*       api_delete
	*
	*       Deletes an item based on given model and id
	*
	*       @return         ArrayCollection
	**/	
	public function api_delete($model,$id = null,$html=false) {
		
		if ($model == 'Category')
		{
			$this->ModelName = ClassRegistry::init('Categories.Category');
		}
		elseif ($model == 'Tag')
		{
			$this->ModelName = ClassRegistry::init('Tags.Tag');
		}
		else
		{
			$this->LoadModel($model);
			$this->ModelName = $this->{$model};
		}
		
		$this->ModelName->id = $id;
		if (!$this->ModelName->exists())
		{
			$data[$model]['id'] 	= $id;
			$data[$model]['msg'] 	= __('Invalid '.$model.' id');
			$data[$model]['result']	= -1;	
		}
		else
		{			
			if ($this->ModelName->delete()) {
				$data[$model]['id'] 	= $id;
				$data[$model]['msg'] 	= __('The '.$model.' has been deleted');
				$data[$model]['result']	= 'OK';					
			} else {
				$data[$model]['id'] 	= $id;
				$data[$model]['msg'] 	= __('The '.$model.'  could not be deleted. Please, try again.');
				$data[$model]['result']	= -1;	
			}

		}
		/* RETURNING THE DATA */
		if ($html)
		{
			debug($data);	
		}
		else
		{
			$return = array('OK');
			if ($data[$model]['result'] != 'OK')
			{
				$return = array($data[$model]['msg']);	
			}
			$dataCollection = new ArrayCollection($return);		
			return $dataCollection;				
		}
	}

	
	/***********************************************************************************************************/
	/*                                     TEST FUNCTIONS                                                      */
	/***********************************************************************************************************/

	function TestArrayCollection( $source = array(), $model = false ){
		if ($model)
		{
			if (isset($source[$model]))
			{
				//We have a single row
				$_source = array(Set::flatten($source));
			}
			else
			{
				//We have more rows
				foreach ($source as $key=>$value)
				{
					$_source[$key] = Set::flatten($value);
				}
			}
			$source = $_source;	
		}
		
		if (!isset($source[0]))
		{
			$source = array($source);
		}
		return $source;

	}	
	
	
	
	// -------------------------------------------------------------------
	/**
	*       api_getUserProductById
	*
	*       Returns a PrinterProduct by id.
	*
	*       @param			id		int			null	
	*       @return         ArrayCollection
	**/	
	function api_getLayoutByProductDimension( $pageHeight = null, $pageWidth = null, $html = false )
	{
	

		$this->loadModel('Theme');	
		$data = array('no pageHeight/pageWidth given!');
		$this->Theme->recursive = -1;
		if (  (isset($pageHeight)) && (isset($pageWidth)) )
		{
			$ThemesData		=	$this->Theme->find('all', 
																	array(
																		'conditions' => array(
																			"page_height" => $pageHeight,
																			"page_width" => $pageWidth,																			
																		),
																		'order' => array(
																			'created DESC'
																		)
																	)
																);

			$data = array('invalid pageHeight/pageWidth given!');
			if (isset($ThemesData[0]['Theme']['id']))
			{
				$data = $ThemesData;
			}
		}
			
		if ($html)
		{
			debug($data);
		}
		else
		{
			$dataCollection = new ArrayCollection($data);	
			return $dataCollection;			
		}		
	}		
	
	
		
		
}
?>
