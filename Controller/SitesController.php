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

/**
*       SoftwaresController
*
*       Interfaces Controller is the interface between the database and the software. This controller handles all requests to the database.
*
*       @author      Frank van der Stad <frank@vanderstad.nl>
*       @package     XHIBIT_SITE
**/

class SitesController extends AppController {

	var $name = 'Sites';
	
 	var $components = array('RequestHandler','Auth', 'Session');
	
	var $uses = array('Ftp.Ftp');
	
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

		$this->autoRender = false;
		
		$this->Auth->allow();

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
    function api_getConfig($platform = 'www', $locale = 'en_US', $html = false)
	{
		$this->Session->write('platform',$platform);
		$this->Session->write('locale',$locale);

		$data[0]['platform']	= $_platform;
		$data[0]['locale']		= $locale;

		if ($html)
		{
			$dataCollection 		= $this->TestArrayCollection($data,'User');		
			$this->set(compact('dataCollection'));
			$this->layout = 'empty';
			$this->render('debug');
		}
		else
		{
			//$dataCollection = new ArrayCollection($data,'User');
			$dataCollection = new ArrayCollection($data);		
			return $dataCollection;			
		}		
		
		return 'Send failed';
	}
	

	//
	// -------------------------------------------------------------------
	/**
	*       products
	*
	*      Handels all the products (listing)
	*
	*       @param			id		int			null	
	*       @return         ArrayCollection
	**/	
	function order_pdf_user_product($id = null)
	{
		$this->loadModel('OrderPdfUserProduct');		
		//$this->OrderPdfUserProduct->Behaviors->load('Containable', array('autoFields' => true), array('recursive ' => true));
		$data 		= array();
		
		if ($this->request->is('get')) {
			if ($id)
			{
				$data = $this->OrderPdfUserProduct->read(null, $id);
			}
			else
			{
				$conditions	= array();
				if (isset($this->request->query['conditions']))
				{
					$conditions = array('conditions'=>$this->request->query['conditions']);
					unset($this->request->query['conditions']);
				}
				if (isset($this->request->query))
				{		
					$conditions = array_merge($conditions,$this->request->query);
				}				
				$data = $this->OrderPdfUserProduct->find('all', $conditions);
			}
				
		}
		/*
		if ( ($this->request->is('post')) || ($this->request->is('put')) ) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The Product has been saved'));
			}
			else
			{
				$this->Session->setFlash(__('The Product has been saved'));
			}

		}
		
		if ($this->request->is('get')) {
			if ($id)
			{
				$data = $this->Product->read(null, $id);
			}
			else
			{
				$data = $this->Product->find('all');
			}
				
		}
		
		if ($this->request->is('delete')) {
			$this->Product->id = $id;
			if (!$this->Product->exists()) {
				throw new NotFoundException(__('Invalid background'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->Product->delete()) {
				$this->Session->setFlash(__('Background deleted'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Background was not deleted'));
			return $this->redirect(array('action' => 'index'));
				
		}	
		*/			
		
		$response = array('data'=> $data, 'success'=>'true');
		$this->set( array( 'response' => $response ) );
		$this->render('index');				
	}
	
	// -------------------------------------------------------------------
	/**
	*       products
	*
	*      Handels all the products (listing)
	*
	*       @param			id		int			null	
	*       @return         ArrayCollection
	**/	
	function supplements($id = null)
	{
		$this->loadModel('Supplement');		
		$this->Supplement->Behaviors->load('Containable', array('autoFields' => true), array('recursive ' => true));
		$data 		= array();
		$findAll	= false;
		if ($this->request->is('get')) {
			if ($id)
			{
				$conditions	= array('conditions'=>array('Supplement.id'=>$id));
				if (isset($this->request->query['conditions']))
				{
					$findAll = true;
					$conditions = array('conditions'=>$this->request->query['conditions']);
					unset($this->request->query['conditions']);
				}
				if (isset($this->request->query))
				{		
					$findAll = true;				
					$conditions = array_merge($conditions,$this->request->query);
				}				

				if ($findAll)
				{
					$data = $this->Supplement->find('first', $conditions);
				}
				else
				{	
					$data = $this->Supplement->read(null, $id);
				}
			}
			else
			{
				$conditions	= array();
				if (isset($this->request->query['conditions']))
				{
					$conditions = array('conditions'=>$this->request->query['conditions']);
					unset($this->request->query['conditions']);
				}
				if (isset($this->request->query))
				{		
					$conditions = array_merge($conditions,$this->request->query);
				}				
				$data = $this->Supplement->find('all', $conditions);
			}
				
		}
		/*
		if ( ($this->request->is('post')) || ($this->request->is('put')) ) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The Product has been saved'));
			}
			else
			{
				$this->Session->setFlash(__('The Product has been saved'));
			}

		}
		
		if ($this->request->is('get')) {
			if ($id)
			{
				$data = $this->Product->read(null, $id);
			}
			else
			{
				$data = $this->Product->find('all');
			}
				
		}
		
		if ($this->request->is('delete')) {
			$this->Product->id = $id;
			if (!$this->Product->exists()) {
				throw new NotFoundException(__('Invalid background'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->Product->delete()) {
				$this->Session->setFlash(__('Background deleted'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Background was not deleted'));
			return $this->redirect(array('action' => 'index'));
				
		}	
		*/			
		
		$response = array('data'=> $data, 'success'=>'true');
		$this->set( array( 'response' => $response ) );
		$this->render('index');				
	}
	
	// -------------------------------------------------------------------
	/**
	*       products
	*
	*      Handels all the products (listing)
	*
	*       @param			id		int			null	
	*       @return         ArrayCollection
	**/	
	function products($id = null)
	{
		$this->loadModel('Product');		
		$this->Product->Behaviors->load('Containable', array('autoFields' => true), array('recursive ' => true));
		$data 		= array();
		$findAll	= false;
		if ($this->request->is('get')) {
			if ($id)
			{
				$conditions	= array('conditions'=>array('Product.id'=>$id));
				if (isset($this->request->query['conditions']))
				{
					$findAll = true;
					$conditions = array('conditions'=>$this->request->query['conditions']);
					unset($this->request->query['conditions']);
				}
				if (isset($this->request->query))
				{		
					$findAll = true;				
					$conditions = array_merge($conditions,$this->request->query);
				}				

				if ($findAll)
				{
					$data = $this->Product->find('first', $conditions);
				}
				else
				{	
					$data = $this->Product->read(null, $id);
				}
			}
			else
			{
				$conditions	= array();
				if (isset($this->request->query['conditions']))
				{
					$conditions = array('conditions'=>$this->request->query['conditions']);
					unset($this->request->query['conditions']);
				}
				if (isset($this->request->query))
				{		
					$conditions = array_merge($conditions,$this->request->query);
				}				
				$data = $this->Product->find('all', $conditions);
			}
				
		}
		/*
		if ( ($this->request->is('post')) || ($this->request->is('put')) ) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The Product has been saved'));
			}
			else
			{
				$this->Session->setFlash(__('The Product has been saved'));
			}

		}
		
		if ($this->request->is('get')) {
			if ($id)
			{
				$data = $this->Product->read(null, $id);
			}
			else
			{
				$data = $this->Product->find('all');
			}
				
		}
		
		if ($this->request->is('delete')) {
			$this->Product->id = $id;
			if (!$this->Product->exists()) {
				throw new NotFoundException(__('Invalid background'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->Product->delete()) {
				$this->Session->setFlash(__('Background deleted'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Background was not deleted'));
			return $this->redirect(array('action' => 'index'));
				
		}	
		*/			
		
		$response = array('data'=> $data, 'success'=>'true');
		$this->set( array( 'response' => $response ) );
		$this->render('index');				
	}
	
	// -------------------------------------------------------------------
	/**
	*       user_product
	*
	*      Handels all the user_product (listing)
	*
	*       @param			id		int			null	
	*       @return         ArrayCollection
	**/		
	function user_product($id = null)
	{
		$this->loadModel('UserProduct');	
		$this->UserProduct->Behaviors->load('Containable', array('autoFields' => true), array('recursive ' => true));
		$data 		= array();
		$success 	= true;
		
		if ($this->request->is('get')) {
			if ($id)
			{
				$data = $this->UserProduct->read(null, $id);
			}
			else
			{
				$conditions	= array();
				if (isset($this->request->query['conditions']))
				{
					$conditions = array('conditions'=>$this->request->query['conditions']);
					unset($this->request->query['conditions']);
				}
				if (isset($this->request->query))
				{		
					$conditions = array_merge($conditions,$this->request->query);
				}
				
				$data = $this->UserProduct->find('all', $conditions);
				$data['type'] = 'get';
			}
		
		} else if ( ($this->request->is('post')) || ($this->request->is('put')) ) {
			$this->UserProduct->create();
			$res = $this->UserProduct->save($this->request->data);
			$success 			= false;
			$data				= $res;
			$data['error'] 		= $this->UserProduct->validationErrors;
			$data['type'] 		= 'post';
			$data['post_data'] 	= $this->request->data;	

			if ($res)
			{
				$success 			= true;
				$data				= $res;				
				$data['error'] 		= false;
				$data['type'] 		= 'post';
				$data['post_data'] 	= $this->request->data;
			}
		}		
		else
		{
			$data = $id;	
		}

		

		$response = array('data'=> $data, 'success'=>$success);
		$this->set( array( 'response' => $response ) );
		$this->layout = 'empty';
		$this->render('index');				
	}	
	
	// -------------------------------------------------------------------
	/**
	*       printer_product
	*
	*      Handels all the printer_products (listing)
	*
	*       @param			id		int			null	
	*       @return         ArrayCollection
	**/		
	function printer_product($id = null)
	{
		$this->loadModel('PrinterProduct');		
		//$this->PrinterProduct->recursive = 2;
		$data 		= array();
		
		if ($this->request->is('get')) {
			if ($id)
			{
				$data = $this->PrinterProduct->read(null, $id);
			}
			else
			{
				$conditions	= array();
				if (isset($this->request->query['conditions']))
				{
					$conditions = array('conditions'=>$this->request->query['conditions']);
					unset($this->request->query['conditions']);
				}
				if (isset($this->request->query))
				{		
					$conditions = array_merge($conditions,$this->request->query);
				}				
				$data = $this->PrinterProduct->find('all', $conditions);
			}
				
		}

		$response = array('data'=> $data, 'success'=>'true');
		$this->set( array( 'response' => $response ) );
		$this->render('index');	
	}
	
	// -------------------------------------------------------------------
	/**
	*       user_product
	*
	*      Handels all the user_product (listing)
	*
	*       @param			id		int			null	
	*       @return         ArrayCollection
	**/		
	function stickers($id = null)
	{
		$this->loadModel('Sticker');		
		//$this->PrinterProduct->recursive = 2;
		$data 		= array();
		
		if ($this->request->is('get')) {
			if ($id)
			{
				$data = $this->Sticker->read(null, $id);
			}
			else
			{
				$conditions	= array();
				if (isset($this->request->query['conditions']))
				{
					$conditions = array('conditions'=>$this->request->query['conditions']);
					unset($this->request->query['conditions']);
				}
				if (isset($this->request->query))
				{		
					$conditions = array_merge($conditions,$this->request->query);
				}				
				$data = $this->Sticker->find('all', $conditions);
			}
				
		}

		$response = array('data'=> $data, 'success'=>'true');
		$this->set( array( 'response' => $response ) );
		$this->render('index');				
	}		
	
	function sticker_categorized()
	{
		$model = 'Sticker';
		$this->LoadModel('Categories.Categorized');
		
		$options = array();
		$options['conditions']['Categorized.model'] = $model;
		$_categorized = $this->Categorized->find('all', $options);
		
		$this->LoadModel($model);
		$this->ModelName = $this->{$model};
		if (empty($this->ModelName->displayField))
		{
			 $this->ModelName->displayField = 'name';
		}
		$this->ModelName->recursive = 0;
		$cat_array = array();
		foreach($_categorized as $categorized)
		{
			$cat_array[$categorized['Category']['name']][] = $categorized['Categorized']['foreign_key'];
		}

		
		foreach($cat_array as $cat_name=>$model_ids)
		{
			if (!empty($model_ids))
			{
				$data[$cat_name] = $this->ModelName->find('all', array(
												'conditions' => array(
													$this->ModelName->alias . '.' .'id' => $model_ids
												),
												'order' => $this->ModelName->alias . '.' . $this->ModelName->displayField . ' ASC',
												'fields' => array(
													$this->ModelName->alias . '.id',
													$this->ModelName->alias . '.' . $this->ModelName->displayField,
													$this->ModelName->alias . '.hires_url',
													$this->ModelName->alias . '.lowres_url',
													$this->ModelName->alias . '.thumb_url',
													$this->ModelName->alias . '.price',
													$this->ModelName->alias . '.id',
													$this->ModelName->alias . '.width',
													$this->ModelName->alias . '.height',
												)
											)
										);
			}
		}

		$response = array('data'=> $data, 'success'=>'true');
		$this->set( array( 'response' => $response ) );
		$this->render('index');	
	}
	
	/**
	*       import
	*
	*       Gets user product data for import into WooCommerce
	*
	**/		
	public function import($id = false)
	{
		$this->autoRender = true;
		$this->loadModel('Product');
		$this->loadModel('UserProduct');
		$this->loadModel('PrinterProduct');
		$conditions = array('UserProduct.id >' => 0);
		$albums		= array();
		if ($id)
		{
			$conditions = array('UserProduct.id'=>$id);	
		}
		$this->UserProduct->recursive = -1;
		$UserProduct = $this->UserProduct->read(null,$id);
		$Product = $this->Product->find('first', array('contain' => array(
														'ProductPaperweight',
														'ProductPapertype',
														'ProductCover',
														'Category',																														
														'PrinterProduct' => array(
															'Printer',
															'PrinterProductPrice',
															'PrinterProductSpine',
														)
													),		
													'order' => 'Product.id DESC',
													'conditions' => array('Product.id'=>$UserProduct['UserProduct']['product_id'])
												)													

											);
		$data = array(array_merge($UserProduct,$Product));											

		foreach($data as $my_album_line)
		{
			foreach($my_album_line['UserProduct'] as $key=>$value)
			{
				if ( strpos($key,'_xml') !== false)
				{
					unset($my_album_line['UserProduct'][$key]);
				}
			}
			$images		= array();
			$categories	= array();			
			$year 		= substr($my_album_line['UserProduct']['modified'], 0, 4);
			$month 		= substr($my_album_line['UserProduct']['modified'], 5, 2);
			$day 		= substr($my_album_line['UserProduct']['modified'], 8, 2);
			$date 		= $day.'/'.$month.'/'.$year;
			
			$title		= $my_album_line['UserProduct']['name'];
			if (empty($title))
			{
				$title		= $my_album_line['Product']['name'];	
			}
			$description 	= '';
			
			$printer_data = $this->PrinterProduct->find('first',array(
																	'conditions' => array(
																		'PrinterProduct.product_id' => $my_album_line['Product']['id']
																	)
																)
															);

			if (isset($my_album_line['Category'][0]['name']))
			{
				$categories = Hash::extract($my_album_line['Category'], '{n}.name');
			}
			else
			{
				$categories = array($my_album_line['Category']['name']);
			}
			
			$tmp_cover_img = 'uprinting/tmp-img-photobooks.png';
			if ($my_album_line['Product']['page_width'] == $my_album_line['Product']['page_height'])
			{
				$categories[] = 'vierkant';	
				$tmp_cover_img = 'uprinting/vierkant/tmp-img-photobooks.png';
			}
			if ($my_album_line['Product']['page_width'] > $my_album_line['Product']['page_height'])
			{
				$categories[] = 'liggend';	
				$tmp_cover_img = 'uprinting/landscape/tmp-img-photobooks.png';
			}
			if ($my_album_line['Product']['page_width'] < $my_album_line['Product']['page_height'])
			{
				$categories[] = 'staand';	
				$tmp_cover_img = 'uprinting/portrait/tmp-img-photobooks.png';
			}
			
			if (!empty($my_album_line['UserProduct']['file_name']))
			{
				$tmp_cover_img = 'webroot/files/coveruploads/'.$my_album_line['UserProduct']['id'].'/'.$my_album_line['UserProduct']['file_name'];
			}
			else
			{
				$tmp_cover_img = 'img/'.$tmp_cover_img;
			}

			$images[] = 'http://api.xhibit.com/v2/'.$tmp_cover_img;			
			/*
			if (!empty($my_album_line['Product']['preview']))
			{
				$images[] = 'http://api.xhibit.com/v2/'.$my_album_line['Product']['preview'];
			}
			*/
			
			$price = '99.99';
			if (isset($printer_data['PrinterProductPrice'][0]['shop_price']))
			{
				$price = sprintf('%01.2f', $printer_data['PrinterProductPrice'][0]['shop_price']);
			}
			
			/*
			$status = 'private';
			if ($my_album_line['Product']['status'] == 'T')
			{
				$status = 'trash';
			}
			$albums['items']['item'][] = array(
				'title'				=> $title,
				'content'			=> $description,						
				'sku'				=> $my_album_line['UserProduct']['id'],						
				'price'				=> $price,
				'tax_status'		=> 'taxable',
				'tax_class'			=> 'reduced-rate',						
				'categories'		=> implode(",",$categories),
				'tags'				=> implode(",",explode(' ',$title)),
				'shipping'			=> array(),
				'images'			=> implode(",",$images),
				'excerpt'			=> $description,
				'slug'				=> strtolower(Inflector::slug($title)),
				'weight'			=> round($my_album_line['Product']['weight']/1000),
				'width'				=> $my_album_line['Product']['page_width'],
				'height'			=> $my_album_line['Product']['page_height'],
				'min_page'			=> $my_album_line['Product']['min_page'],
				'max_page'			=> $my_album_line['Product']['max_page'],
				'linked_ids'		=> implode(",",array($my_album_line['Product']['id'])),
				'cross_sell_ids'	=> false,
				'date'				=> $date,
				'paper_weight'		=> $my_album_line['ProductPaperweight']['title'],
				'paper_type'		=> $my_album_line['ProductPapertype']['title'],
				'product_cover'		=> $my_album_line['ProductCover']['name'],
				'status'			=> $status,
			);
			*/
			$status = 'private';
			if ($my_album_line['Product']['status'] == 'T')
			{
				$status = 'trash';
			}
			$tags = array();
			$_tags = explode(' ',$title);
			foreach($_tags as $tag)
			{
				if (strlen($tag)>3)
				{
					$tags[] = preg_replace('/[^a-zA-Z0-9]/s', '', $tag); 
				}
			}		
			
			$extra_pages = $my_album_line['UserProduct']['numpages']-$my_album_line['Product']['min_page'];
			if ($extra_pages < 0)
			{
				$extra_pages = 0;
			}
			$album['items']['item'][] = array(
				'post_title'						=> $title,
				'post_content'						=> $description,	
				'_sku'								=> $my_album_line['UserProduct']['id'],
				'_regular_price'					=> $price,
				'_tax_status'						=> 'taxable',
				'_tax_class'						=> 'reduced-rate',						
				'product_cat_by_name'				=> implode("|",$categories),
				'product_tag_by_name'				=> $tags,
				'product_shipping_class_by_name'	=> false,
				'product_image_by_url'				=> implode("|",$images),
				'post_excerpt'						=> $description,
				'_product_url'						=> strtolower(Inflector::slug(md5($my_album_line['Product']['id']).'_'.$title)),
				'_weight'							=> round($my_album_line['Product']['weight']/1000),
				'_width'							=> $my_album_line['Product']['page_width'],
				'_height'							=> $my_album_line['Product']['page_height'],
				'post_status'						=> $status,
				'menu_order'						=> '1',
				'_visibility'						=> 'hidden',
				'_featured'							=> 'no',
				'_stock'							=> 99999,
				'_stock_status'						=> 'instock',
				'_backorders'						=> 'no',
				'_manage_stock'						=> 'no',
				'comment_status'					=> 'closed',
				'ping_status'						=> 'closed',
				'_sale_price'						=> false,
				'_downloadable'						=> 'no',
				'_virtual'							=> 'no',
				'_product_type'						=> 'simple',
				'linked_ids'						=> implode(",",array($my_album_line['Product']['id'])),
				'cross_sell_ids'					=> false,
				'extra_pages'						=> $extra_pages,
				'custom_field'						=> array(
															1=>array(
																'name'		=> 'min_page',
																'value'		=> $my_album_line['Product']['min_page'],
																'visible' 	=> 0
															),
															2=>array(
																'name'		=> 'max_page',
																'value'		=> $my_album_line['Product']['min_page'],
																'visible' 	=> 0
															),
															3=>array(
																'name'		=> 'cur_page',
																'value'		=> $my_album_line['UserProduct']['numpages'],
																'visible' 	=> 0
															),
															4=>array(
																'name'		=> 'paper_weight',
																'value'		=> $my_album_line['ProductPaperweight']['title'],
																'visible' 	=> 0
															),
															5=>array(
																'name'		=> 'paper_type',
																'value'		=> $my_album_line['ProductPapertype']['title'],
																'visible' 	=> 0
															),
															6=>array(
																'name'		=> 'product_cover',
																'value'		=> $my_album_line['ProductCover']['name'],	
																'visible' 	=> 0
															),	
															7=>array(	
																'name'		=> 'user_product_id',
																'value'		=> $my_album_line['UserProduct']['id'],
																'visible' 	=> 0
															),	
															8=>array(	
																'name'		=> 'shop_product_price',
																'value'		=> $printer_data['PrinterProductPrice'][0]['shop_product_price'],
																'visible' 	=> 0
															),	
															9=>array(	
																'name'		=> 'shop_product_page_price',
																'value'		=> $printer_data['PrinterProductPrice'][0]['shop_product_page_price'],
																'visible' 	=> 0
															),	
															10=>array(	
																'name'		=> 'shop_price_method',
																'value'		=> $printer_data['PrinterProductPrice'][0]['shop_price_method'],
																'visible' 	=> 0
															),																																														
															11=>array(
																'name'		=> 'Huidig aantal pagina\'s',
																'value'		=> $my_album_line['UserProduct']['numpages'],
																'visible' 	=> 1
															)																																																																								
														)
			
			);
			
		}
		
		$this->set(compact('albums','data','album'));
		if ($this->RequestHandler->isXml()) {
	
			if ($id)
			{
				$albums = $album;
			}
			$xml = Xml::fromArray($albums);
			$this->response->body($xml->asXML());
			$this->response->type('xml');
		
			//Optionally force file download
			$this->response->download('products.xml');
		
			//Return response object to prevent controller from trying to render a view
			return $this->response;
		}	
	}
	
	
	public function getstatusupdates($platform = false)
	{
		
		$this->autoRender 	= true;
		if ($platform)
		{
			try {
				$this->Ftp->useDbConfig = 'provider_ftp_'.$platform;

				$files = $this->Ftp->find('all', array('conditions' => array('path' => '/uit')));
				foreach($files as $file)
				{
					if (substr($file['Ftp']['filename'],0,6) == 'status')
					{
						$local_file = WWW_ROOT.'/files/statusupdates/'.$file['Ftp']['filename'];
						if ($this->Ftp->save(array(
							'local' => $local_file,
							'remote' => $file['Ftp']['path'].$file['Ftp']['filename'],
							'direction' => 'down',
						))) {
							
							$albums = Xml::build($local_file);
							$albums = Set::reverse($albums); // this is what i call magic
							$my_to_save_array = Hash::combine($albums['status_data'], 'status_change.{n}.new_status.@date','status_change.{n}.new_status.@','status_change.{n}.reference.@reforderid');
							foreach($my_to_save_array as $key=>$value)
							{
								foreach($value as $date=>$status)
								{
									$to_save_array[] = array('order_id'=>$key, 'date'=>$date, 'status'=>$status, 'created'=>date('Y-m-d H:i:s'));	
								}	
							}
							
							$this->loadModel('OrderStatus');
							$res = $this->OrderStatus->saveAll($to_save_array);
							try {
								if ($this->Ftp->delete($file['Ftp']['path'].$file['Ftp']['filename'])) {
									//echo 'file deleted';
								}
							} catch (Exception $e) {
								debug($e->getMessage());
							}
						}	
					}
				}
			
				if ($this->RequestHandler->isXml()) {
			
					if (isset($albums))
					{
						$xml = Xml::fromArray($albums);
						$this->response->body($xml->asXML());
						$this->response->type('xml');			
					
						//Optionally force file download
						$this->response->download('status.xml');
					
						//Return response object to prevent controller from trying to render a view
						return $this->response;
					}
					
					die();
				}	
				
				if (!isset($albums))
				{
					$albums = 'Geen album gevonden!';	
				}
				$this->set(compact('albums'));	
						
							
			} catch (Exception $e) {
				
				debug($e->getMessage());
				
			}

		}
	}
	
	/**
	*       feed
	*
	*       Gets all products for import into WooCommerce
	*
	**/			
	public function feed($id = false)
	{
		$this->autoRender = true;
		$this->loadModel('Product');
		$this->loadModel('PrinterProduct');
		$conditions = array('Product.status' => 'A');
		$albums		= array();
		if ($id)
		{
			$conditions = array('Product.id'=>$id);	
		}
		$data = $this->Product->find('all', array('contain' => array(
														'ProductPaperweight',
														'ProductPapertype',
														'ProductCover',
														'Category',																														
														'PrinterProduct' => array(
															'Printer',
															'PrinterProductPrice',
															'PrinterProductSpine',
														)
													),		
													'order' => 'Product.id DESC',
													'conditions' => $conditions
												)													

											);
		foreach($data as $my_album_line)
		{
			$images		= array();
			$categories	= array();			
			$year 		= substr($my_album_line['Product']['created'], 0, 4);
			$month 		= substr($my_album_line['Product']['created'], 5, 2);
			$day 		= substr($my_album_line['Product']['created'], 8, 2);
			$date 		= $day.'/'.$month.'/'.$year;
			
			$title	= $my_album_line['Product']['name'];
			$description 	= '';
			
			$printer_data = $this->PrinterProduct->find('first',array(
																	'conditions' => array(
																		'PrinterProduct.product_id' => $my_album_line['Product']['id']
																	)
																)
															);

			if (isset($my_album_line['Category'][0]['name']))
			{
				$categories = Hash::extract($my_album_line['Category'], '{n}.name');
			}
			else
			{
				$categories = array($my_album_line['Category']['name']);
			}
			$tmp_cover_img = 'uprinting/tmp-img-photobooks.png';
			if ($my_album_line['Product']['page_width'] == $my_album_line['Product']['page_height'])
			{
				$categories[] = 'vierkant';	
				$tmp_cover_img = 'uprinting/vierkant/tmp-img-photobooks.png';
			}
			if ($my_album_line['Product']['page_width'] > $my_album_line['Product']['page_height'])
			{
				$categories[] = 'liggend';	
				$tmp_cover_img = 'uprinting/landscape/tmp-img-photobooks.png';
			}
			if ($my_album_line['Product']['page_width'] < $my_album_line['Product']['page_height'])
			{
				$categories[] = 'staand';	
				$tmp_cover_img = 'uprinting/portrait/tmp-img-photobooks.png';
			}

					
			if (!empty($my_album_line['Product']['preview']))
			{
				$images[] = 'http://api.xhibit.com/v2/img/'.$my_album_line['Product']['preview'];
			}
			else
			{
				$images[] = 'http://api.xhibit.com/v2/img/'.$tmp_cover_img;		
			}
			
			$price = '99.99';
			if (isset($printer_data['PrinterProductPrice'][0]['shop_price']))
			{
				$price = sprintf('%01.2f', $printer_data['PrinterProductPrice'][0]['shop_price']);
			}
			
			$status = 'draft';
			if ($my_album_line['Product']['status'] == 'A')
			{
				$status = 'publish';
			}
			
			$tags = array();
			$_tags = explode(' ',$title);
			foreach($_tags as $tag)
			{
				if (strlen($tag)>3)
				{
					$tags[] = preg_replace('/[^a-zA-Z0-9]/s', '', $tag); 
				}
			}
			
			$albums['items']['item'][] = array(
				'title'						=> $title,
				'content'					=> $description,						
				'sku'						=> $my_album_line['Product']['id'],						
				'price'						=> $price,
				'tax_status'				=> 'taxable',
				'tax_class'					=> 'reduced-rate',						
				'categories'				=> implode(",",$categories),
				'tags'						=> $tags,
				'shipping'					=> array(),
				'images'					=> implode(",",$images),
				'excerpt'					=> $description,
				'slug'						=> strtolower(Inflector::slug($title)),
				'weight'					=> round($my_album_line['Product']['weight']/1000),
				'width'						=> $my_album_line['Product']['page_width'],
				'height'					=> $my_album_line['Product']['page_height'],
				'min_page'					=> $my_album_line['Product']['min_page'],
				'max_page'					=> $my_album_line['Product']['max_page'],
				'linked_ids'				=> array(),
				'cross_sell_ids'			=> array(),		
				'date'						=> $date,
				'paper_weight'				=> $my_album_line['ProductPaperweight']['title'],
				'paper_type'				=> $my_album_line['ProductPapertype']['title'],
				'product_cover'				=> $my_album_line['ProductCover']['name'],
				'status'					=> $status,
				'shop_product_price' 		=> $printer_data['PrinterProductPrice'][0]['shop_product_price'],
				'shop_product_page_price' 	=> $printer_data['PrinterProductPrice'][0]['shop_product_page_price'],
				'shop_price_method' 		=> $printer_data['PrinterProductPrice'][0]['shop_price_method'],					
			);
			$status = 'private';
			if ($my_album_line['Product']['status'] == 'A')
			{
				$status = 'publish';
			}
			$album['items']['item'][] = array(
				'post_title'						=> $title,
				'post_content'						=> $description,						
				'_sku'								=> $my_album_line['Product']['id'],
				'_regular_price'					=> $price,
				'_tax_status'						=> 'taxable',
				'_tax_class'						=> 'reduced-rate',						
				'product_cat_by_name'				=> implode("|",$categories),
				'product_tag_by_name'				=> $tags,
				'product_shipping_class_by_name'	=> false,
				'product_image_by_url'				=> implode("|",$images),
				'post_excerpt'						=> $description,
				'_product_url'						=> strtolower(Inflector::slug(md5($my_album_line['Product']['id']).'_'.$title)),
				'_weight'							=> round($my_album_line['Product']['weight']/1000),
				'_width'							=> $my_album_line['Product']['page_width'],
				'_height'							=> $my_album_line['Product']['page_height'],
				'post_status'						=> $status,
				'menu_order'						=> '1',
				'_visibility'						=> 'hidden',
				'_featured'							=> 'no',
				'_stock'							=> 99999,
				'_stock_status'						=> 'instock',
				'_backorders'						=> 'no',
				'_manage_stock'						=> 'no',
				'comment_status'					=> 'closed',
				'ping_status'						=> 'closed',
				'_sale_price'						=> false,
				'_downloadable'						=> 'no',
				'_virtual'							=> 'no',
				'_product_type'						=> 'simple',
				'custom_field'						=> array(
															1=>array(
																'name'		=> 'min_page',
																'value'		=> $my_album_line['Product']['min_page'],
																'visible' 	=> 1
															),
															2=>array(
																'name'		=> 'max_page',
																'value'		=> $my_album_line['Product']['max_page'],
																'visible' 	=> 1
															),
															3=>array(
																'name'		=> 'cur_page',
																'value'		=> $my_album_line['Product']['min_page'],
																'visible' 	=> 1
															),
															4=>array(
																'name'		=> 'paper_weight',
																'value'		=> $my_album_line['ProductPaperweight']['title'],
																'visible' 	=> 1
															),
															5=>array(
																'name'		=> 'paper_type',
																'value'		=> $my_album_line['ProductPapertype']['title'],
																'visible' 	=> 1
															),
															6=>array(
																'name'		=> 'product_cover',
																'value'		=> $my_album_line['ProductCover']['name'],	
																'visible' 	=> 1
															),
															7=>array(	
																'name'		=> 'user_product_id',
																'value'		=> 0,
																'visible' 	=> 0
															),	
															8=>array(	
																'name'		=> 'shop_product_price',
																'value'		=> $printer_data['PrinterProductPrice'][0]['shop_product_price'],
																'visible' 	=> 0
															),	
															9=>array(	
																'name'		=> 'shop_product_page_price',
																'value'		=> $printer_data['PrinterProductPrice'][0]['shop_product_page_price'],
																'visible' 	=> 0
															),	
															10=>array(	
																'name'		=> 'shop_price_method',
																'value'		=> $printer_data['PrinterProductPrice'][0]['shop_price_method'],
																'visible' 	=> 0
															),																																																																												
														)
			
			);
			
		}
		
		$this->set(compact('albums','data','album'));
		
		if ($this->RequestHandler->isXml()) {
	
			if ($id)
			{
				$albums = $album;
			}
			$xml = Xml::fromArray($albums);
			$this->response->body($xml->asXML());
			$this->response->type('xml');
		
			//Optionally force file download
			$this->response->download('products.xml');
		
			//Return response object to prevent controller from trying to render a view
			return $this->response;
		}

	}	

	/**
	*       feed
	*
	*       Gets all products for import into WooCommerce
	*
	**/			
	public function exporti($printer_id = 68, $id = false)
	{
		if (isset($this->request->params['ext']) && ($this->request->params['ext'] == 'csv'))
		{
			//Configure::write('debug', 0);
		}
		$this->autoRender = true;
		$this->loadModel('Product');
		$this->loadModel('PrinterProduct');
		$conditions = array('Product.status' => 'A');
		$albums		= array();
		if ($id)
		{
			$conditions = array('Product.id'=>$id);	
		}
		$this->Product->recursive = 0;
		$data = $this->Product->find('all', array('contain' => array(
														'ProductPaperweight',
														'ProductPapertype'
													),		
													'order' => 'Product.id DESC',
													'conditions' => $conditions
												)													
											);

		foreach($data as $my_album_line)
		{
			$images		= array();
			$categories	= array();			
			$year 		= substr($my_album_line['Product']['created'], 0, 4);
			$month 		= substr($my_album_line['Product']['created'], 5, 2);
			$day 		= substr($my_album_line['Product']['created'], 8, 2);
			$date 		= $day.'/'.$month.'/'.$year;
			
			$title	= $my_album_line['Product']['name'];
			$description 	= '';
			
			$this->PrinterProduct->recursive = 1;
			$printer_data = $this->PrinterProduct->find('first',array(
																	'conditions' => array(
																		'PrinterProduct.product_id' => $my_album_line['Product']['id'],
																		'Printer.id' => $printer_id
																	),
																	'contain' => array(
																		'Printer',
																		'PrinterProductPrice',
																		'PrinterProductSpine',
																		'PrinterProductCover',																																																						
																	),
																)
															);
			unset($printer_data['Product']);
			unset($printer_data['ProductCover']);
			//debug($printer_data);
			//die();
			//$printer_data['PrinterProductCover'] = $printer_data['PrinterProductCover'][0];
			$my_album_line = array_merge($my_album_line,$printer_data);

			$this->Product->ProductCover->recursive = 0;
			$_cover_data = $this->Product->ProductCover->find('first',array(
																	'conditions' => array(
																		'ProductCover.id' => $my_album_line['Product']['product_cover_id'],
																	),
																	'contain' => array(
																		'ProductPaperweight',
																		'ProductPapertype'
																	),
																)
															);	
			$cover_data = array();
			if (isset($_cover_data['ProductCover']))
			{
				$cover_data							= $_cover_data['ProductCover'];
				$cover_data['ProductPaperweight']	= $_cover_data['ProductPaperweight'];
				$cover_data['ProductPapertype']		= $_cover_data['ProductPapertype'];
			}
			$my_album_line['ProductCover']		= $cover_data; 
			
			unset($my_album_line['Category']);
			unset($my_album_line['ParentProduct']);
			
			$albums[] = $my_album_line;
			
		}
		
		$retdata	= $albums;
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
		$_extract[] = 'ProductPaperweight.name';
		$_header[] 	= 'Papertype';								
		$_extract[] = 'ProductPapertype.name';

	
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
		if (isset($this->request->params['ext']) && ($this->request->params['ext'] == 'csv'))
		{
			//Configure::write('debug', 0);
			$this->autoRender = true;
			$this->response->download('my_file.csv'); // <= setting the file name				
			$this->viewClass = 'CsvView.Csv';
			$this->set(compact('retdata', '_serialize', '_header', '_extract'));
		}
		else
		{
			Configure::write('debug', 2);
			debug($retdata);
			die();			
		}

	}	
	

	
	/**
	*       sendto_pdf_engine
	*
	*       Creates a entry for the PDF Engine
	*
	**/		
	public function sendto_pdf_engine($order_id = false, $userproduct_id = false, $user_id = false, $status = 'start', $html = false)
	{
		$this->autoRender = true;
		$data = array();
		$this->LoadModel('OrderPdf');
		$this->LoadModel('UserProduct');
		$this->LoadModel('PrinterProduct');
		$this->LoadModel('OrderPdfUserProduct');
		$data = array('has_error'=>'no UserProductId');
		if ($userproduct_id)
		{
			$_user_product 		= $this->UserProduct->find('first',array('conditions'=>array('UserProduct.id'=>$userproduct_id)));
			$printer_product 	= $this->PrinterProduct->find('first', array(
																		'conditions' => array(
																			'PrinterProduct.product_id' => $_user_product['UserProduct']['product_id'],
																			//'PrinterProduct.status'=>'A'
																		)
																	)
			);

			$user_product = array_merge($_user_product,$printer_product);
			
			$data = array('has_error'=>'no UserProduct');
			if (isset($user_product['UserProduct']['id']))
			{
				if (empty($user_product['UserProduct']['usedcolor_xml']))
				{
					$user_product['UserProduct']['usedcolor_xml'] = '<root><color uint="65535"/></root>';
				}

				$order_pdf_user_product['OrderPdfUserProduct'] 							= $user_product['UserProduct'];
				$order_pdf_user_product['OrderPdfUserProduct']['user_product_id'] 		= $user_product['UserProduct']['id'];
				$order_pdf_user_product['OrderPdfUserProduct']['printer_product_id'] 	= $user_product['PrinterProduct']['id'];
				unset($order_pdf_user_product['OrderPdfUserProduct']['id']);
				$this->OrderPdfUserProduct->create();
				
				$data = array('has_error'=>'no OrderPdfUserProduct');
				if ($this->OrderPdfUserProduct->save($order_pdf_user_product))
				{
					$this->OrderPdf->create();
					$OrderPdf['OrderPdf']['user_id']					= $user_id;
					$OrderPdf['OrderPdf']['order_id']					= $order_id;
					$OrderPdf['OrderPdf']['order_pdf_user_product_id']	= $this->OrderPdfUserProduct->id;
					$OrderPdf['OrderPdf']['status'] 					= $status;
					
					//Check if we have a webprint item
					if ($user_product['Printer']['id'] == 67)
					{
						$OrderPdf['OrderPdf']['status'] 				= 'startJPG';
						//Check if we have a SPE AND it is a webprint item
						if ($_user_product['UserProduct']['numpages'] <= 2)
						{
							$OrderPdf['OrderPdf']['status']			= 'finished';
							$OrderPdf['OrderPdf']['document_xml']	= $_user_product['UserProduct']['parsed_product_xml'];
							$OrderPdf['OrderPdf']['path_bbloc']		= '/data/web/fotoalbum/fotoalbum.nl/dev/webroot/files/coveruploads/'.$_user_product['UserProduct']['id'].'/'.$_user_product['UserProduct']['file_name'];
						}						
					}
					
					$data = array('has_error'=>'no OrderPdf');
					if ($this->OrderPdf->save($OrderPdf))
					{		
						$fields = array(	
							'OrderPdf.*',		
							'OrderPdfUserProduct.id',
							'OrderPdfUserProduct.user_id',
							'OrderPdfUserProduct.product_id',
							'OrderPdfUserProduct.user_product_id',
							'OrderPdfUserProduct.printer_product_id',
							'OrderPdfUserProduct.pages_xml'
						);
						$data = $this->OrderPdf->find('first', array(
																'conditions' => array(
																	'OrderPdf.id'=>$this->OrderPdf->id
																),
																'fields'=>$fields
															)
														);	
					}
				}
			}
		}
				
		$album = $data;		
		$this->set(compact('data','album'));

	}	

	/**
	*       sendto_pdf_engine
	*
	*       Creates a entry for the PDF Engine
	*
	**/		
	public function renew_status_pdf_engine($order_id = false, $user_product_id = false)
	{
		$this->autoRender = true;
		$data = $albums = array();
		$fields = array(	
			'OrderPdf.*',		
			'OrderPdfUserProduct.id',
			'OrderPdfUserProduct.user_id',
			'OrderPdfUserProduct.product_id',
			'OrderPdfUserProduct.user_product_id',
			'OrderPdfUserProduct.printer_product_id'
		);			
		$this->LoadModel('OrderPdf');		
		$data = $this->OrderPdf->find('first', array(
												'conditions' => array(
													'OrderPdf.order_id'=>$order_id,
													'OrderPdfUserProduct.user_product_id'=>$user_product_id
												),
												'fields' => $fields
											)
										);
		self::check_status_pdf_engine($data['OrderPdf']['id']);
		
	}
	/**
	*       sendto_pdf_engine
	*
	*       Creates a entry for the PDF Engine
	*
	**/		
	public function check_status_pdf_engine($pdf_engine_id = false, $return_method = 'print')
	{
		$this->autoRender = true;
		$data = array();
		$this->LoadModel('OrderPdf');
		$this->LoadModel('Product');
		$this->LoadModel('PrinterProduct');
		$fields = array(	
			'OrderPdf.*',		
			'OrderPdfUserProduct.id',
			'OrderPdfUserProduct.user_id',
			'OrderPdfUserProduct.product_id',
			'OrderPdfUserProduct.user_product_id',
			'OrderPdfUserProduct.printer_product_id'
		);		
		$data = $this->OrderPdf->find('first', array(
												'conditions' => array(
													'OrderPdf.id'=>$pdf_engine_id
												),
												'fields' => $fields
											)
										);
		$_data = $this->PrinterProduct->find('first', array(
												'conditions' => array(
													'PrinterProduct.id'=>$data['OrderPdfUserProduct']['printer_product_id']
												),
												'fields' => array(	
													'PrinterProduct.id',
													'PrinterProduct.name',		
													'PrinterProduct.xml_name',
													'PrinterProduct.product_id',
													'PrinterProduct.printer_id',
													'PrinterProduct.product_cover_id',
													'PrinterProduct.printer_product_cover_id',
													'PrinterProduct.status'
												),
												'recursive' => 1
											)
										);
		$__data = $this->Product->find('first', array(
												'conditions' => array(
													'Product.id'=>$data['OrderPdfUserProduct']['product_id']
												),
												'fields' => array(	
													'Product.product_cover_id',
													'Product.product_paperweight_id',
													'Product.product_papertype_id',													
													'ProductCover.*',
													'ProductPaperweight.id',
													'ProductPaperweight.name',
													'ProductPapertype.id',
													'ProductPapertype.name'														
												),
												'contains' => array(
													'ProductPaperweight' => array(
														'ProductPaperweight.id',
														'ProductPaperweight.printer_id',
														'ProductPaperweight.name',
														'ProductPaperweight.title',
													),
													'ProductPapertype' => array(
														'ProductPapertype.id',
														'ProductPapertype.printer_id',
														'ProductPapertype.name',
														'ProductPapertype.title',
													),
												),
												'recursive' => 2
											)
										);	
		//debug($__data);
		unset($__data['PrinterProduct']);										
		unset($__data['ProductCover']['Product']);
		unset($__data['ProductCover']['PrinterProduct']);
		unset($__data['ProductPaperweight']['Product']);	
		unset($__data['ProductPaperweight']['Printer']);	
		unset($__data['ProductPapertype']['Product']);
		unset($__data['ProductPapertype']['ProductCover']);			
		unset($__data['ProductPapertype']['Printer']);					
		unset($__data['ParentProduct']);		
		unset($__data['Category']);		
		unset($__data['ProductSingle']);		
		unset($__data['ChildProduct']);		
		//debug($__data);
		
		if ($_data['PrinterProduct']['printer_product_cover_id'] > 0)
		{
			$___data = $this->PrinterProduct->PrinterProductCover->find('first', array(
													'conditions' => array(
														'PrinterProductCover.id'=>$_data['PrinterProduct']['printer_product_cover_id']
													),
													'recursive' => 0
												)
											);	
											
			$____data['PrinterProductCover'] = array($___data['PrinterProductCover']);
		}
		else
		{
			$____data['PrinterProductCover'] = array();
		}
		$album = array_merge($data,$_data,$__data,$____data);	

		if ($return_method == 'return')
		{
			return $album;	
		}
		$this->set(compact('data','album'));

	}
	
	/**
	*       sendto_pdf_engine
	*
	*       Creates a entry for the PDF Engine
	*
	**/		
	public function check_status_order($order_id = false)
	{
		$this->autoRender = true;
		$data = array();
		$this->LoadModel('OrderStatus');
		$fields = array(	
			'OrderStatus.*',		
		);		
		$order_id = str_replace("order_","",$order_id);
		$data = $this->OrderStatus->find('first', array(
												'conditions' => array(
													'OrderStatus.order_id LIKE'=>$order_id.'-%'
												),
												'order' => array(
													'OrderStatus.id' => 'desc'
												),
												'fields' => $fields
											)
										);
		$album = $data;	

		$this->set(compact('data','album'));

	}
	
	public function fix_engine_details($order_id = false, $userproduct_id = false, $user_id = false)
	{
		$this->autoRender = true;
		$data = array();
		$this->LoadModel('OrderPdf');
		$this->LoadModel('OrderPdfUserProduct');
		$data = array('has_error'=>'no UserProductId');

		$fields = array(	
			'OrderPdf.*',		
			'OrderPdfUserProduct.id',
			'OrderPdfUserProduct.user_id',
			'OrderPdfUserProduct.product_id',
			'OrderPdfUserProduct.user_product_id',
			'OrderPdfUserProduct.printer_product_id',
			//'OrderPdfUserProduct.pages_xml'
		);
		$_data = $this->OrderPdfUserProduct->find('first', array(
												'conditions' => array(
													'OrderPdfUserProduct.user_product_id'=>$userproduct_id,
													'OrderPdfUserProduct.user_id'=>$user_id,		
												),
												'fields' => array(
													'OrderPdfUserProduct.id'
												)
											)
										);			
		$data = $this->OrderPdf->find('first', array(
												'conditions' => array(
													'OrderPdf.order_id'=>$order_id,
													'OrderPdf.order_pdf_user_product_id'=>$_data['OrderPdfUserProduct']['id'],
												),
												'fields'=>$fields
											)
										);	
		$album = $data;		
		$this->set(compact('data','album'));
	}
		
		
	
}
?>