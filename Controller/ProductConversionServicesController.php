<?php
App::uses('AppController', 'Controller');
/**
 * ProductConversionServices Controller
 *
 * @property ProductConversionService $ProductConversionService
 * @property PaginatorComponent $Paginator
 */
class ProductConversionServicesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Zip.zip');

	 public $paginate = array(
			'limit' => 50,
			'conditions' => array(
				'ProductConversionService.status >=' => 0
			)
		);
/**
 * beforeFilter method
 *
 * @return void
 */
    public function beforeFilter() {
		
		parent::beforeFilter();
		
		$og_data['og:url'] 			= Router::url($this->here, true);
		$og_data['og:title'] 		= '';
		$og_data['og:description'] 	= '';
		$og_data['og:image'] 		= '';
		$og_data['og:type']			= 'website';
		$og_data['og:site_name']	= CakeRequest::host();
		
		$this->set(compact('og_data'));		
    }	

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ProductConversionService->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->set('productConversionServices', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductConversionService->exists($id)) {
			throw new NotFoundException(__('Invalid product conversion service'));
		}
		$options = array('conditions' => array('ProductConversionService.' . $this->ProductConversionService->primaryKey => $id));
		$this->set('productConversionService', $this->ProductConversionService->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductConversionService->create();
			if ($this->ProductConversionService->save($this->request->data)) {
				$this->Session->setFlash(__('The product conversion service has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product conversion service could not be saved. Please, try again.'));
			}
		}
		$users = $this->ProductConversionService->User->find('list');
		$productConversions = $this->ProductConversionService->ProductConversion->find('list');
		$products = $this->ProductConversionService->Product->find('list');
		$this->set(compact('users', 'productConversions', 'products'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		
		$this->loadModel('Fontfamily');
		$fonts = $this->Fontfamily->find('list');
		
		if (!$this->ProductConversionService->exists($id)) {
			throw new NotFoundException(__('Invalid product conversion service'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductConversionService->save($this->request->data)) {
				$this->Session->setFlash(__('The product conversion service has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product conversion service could not be saved. Please, try again.'));
			}
		} else {
			$options = array(
							'conditions' => array(
								'ProductConversionService.' . $this->ProductConversionService->primaryKey => $id
							)
						);
			$return_data		= $this->ProductConversionService->find('first', $options);
			
			//Zoeken naar de zoek & vervang van bestandsnamen (upload vs CEWE)
			$_array_photos		= json_decode($return_data['ProductConversionService']['photos'], true);
			foreach($_array_photos as $array_photo)
			{
				if (isset($array_photo['visible']))
				{
					$array_photos[] = $array_photo;
				}
			}
			$search				= Hash::extract($array_photos, '{n}.original_filename');
			$replace			= Hash::extract($array_photos, '{n}.hires');
	
			$return_data['ProductConversionService']['mcf_content'] = str_replace($search, $replace, $return_data['ProductConversionService']['mcf_content']);


			//Parsing van de MCF
			$xml_mcf_content	= simplexml_load_string($return_data['ProductConversionService']['mcf_content'], "SimpleXMLElement", LIBXML_NOCDATA);
			$json_mcf_content	= json_encode($xml_mcf_content);
			$array_mcf_content	= json_decode($json_mcf_content,TRUE);			
			
			
			$return_data['ProductConversionService']['mcf_content_array'] 	= $array_mcf_content;
			$return_data['ProductConversionService']['photos_array'] 		= $array_photos;	
			
			$txt 				= $array_mcf_content;

			
			$return_data['ProductConversionService']['designElementID']['details'] = Hash::extract($txt, '@attributes');
			
			// Get the desgin elements
			$designElementIDs 	= Hash::extract($txt, 'page.{n}.designElementIDs');
			
			
			// find all the used backgrounds
			$bg_1				= Hash::extract($txt, 'page.{n}.background.@attributes.templatename');
			$bg_2				= Hash::extract($txt, 'page.{n}.background.{n}.@attributes.templatename');	
			$backgrounds		= array_merge($bg_1,$bg_2);
			$background_counter	= 0;
			$background_array	= array();
			
			$background_s		= array(',normal,', ',normal');
			foreach($backgrounds as $background_key=>$_background_value)
			{
				
				$background_value = str_replace($background_s,'',$_background_value);
				if (!isset($background_array[$background_value]))
				{
					$background_array[$background_value] = 0;
				}
				$background_array[$background_value] = $background_array[$background_value] + 1;
				$background_counter++;
			}
			
			$return_data['ProductConversionService']['designElementID']['backgrounds']['counter']	= $background_counter;
			$return_data['ProductConversionService']['designElementID']['backgrounds']['items']		= $background_array;

			// find all the used layouts
			/*
			$layouts	 		= Hash::extract($designElementIDs, '{n}.@attributes.layout');
			$layout_counter		= 0;	
			$layout_array		= array();
			foreach($layouts as $layout_key=>$layout_value)
			{
				if (!isset($layout_array[$layout_value]))
				{
					$layout_array[$layout_value] = 0;
				}
				$layout_array[$layout_value] = $layout_array[$layout_value] + 1;
				$layout_counter++;
			}
			
			$return_data['ProductConversionService']['designElementID']['layouts']['counter']	= $layout_counter;
			$return_data['ProductConversionService']['designElementID']['layouts']['items']		= $layout_array;
			*/

			// find all the used passepartout
			$passepartouts	 		= Hash::extract($designElementIDs, '{n}.@attributes.passepartout');
			$passepartout_counter	= 0;
			$passepartout_array		= array();
			foreach($passepartouts as $passepartout_key=>$passepartout_value)
			{
				if (!isset($passepartout_array[$passepartout_value]))
				{
					$passepartout_array[$passepartout_value] = 0;
				}
				$passepartout_array[$passepartout_value] = $passepartout_array[$passepartout_value] + 1;
				$passepartout_counter++;
			}
			
			$return_data['ProductConversionService']['designElementID']['passepartouts']['counter']	= $passepartout_counter;
			$return_data['ProductConversionService']['designElementID']['passepartouts']['items']	= $passepartout_array;

			//Find all the used fonts
			$fontElementIDs 	= Hash::extract($txt, 'page.{n}.area.{n}.text');
			$font_counter		= 0;
			$font_errors		= array();
			foreach($fontElementIDs as $fontId=>$fontElements)
			{
				$_text	= simplexml_load_string($fontElements, "SimpleXMLElement", LIBXML_NOCDATA);
				preg_match("/\/(.*)(font-family:')(.*)(';.*)/", $fontElements, $_font_array);
				if (isset($_font_array[3]))
				{
					$font_value = $_font_array[3];
					if (!isset($font_array[$font_value]))
					{
						$font_array[$font_value] = 0;
					}
					$font_array[$font_value] = $font_array[$font_value] + 1;
					$font_counter++;	
		
					if (!in_array(strtolower($font_value), array_map('strtolower', $fonts)))
					{
						if (!in_array($font_value,$font_errors))
						{
							$font_errors[] = $font_value;
						}						
					}
				}
			}

			$return_data['ProductConversionService']['designElementID']['fonts']['counter']	= $font_counter;
			$return_data['ProductConversionService']['designElementID']['fonts']['items']	= $font_array;
			$return_data['ProductConversionService']['designElementID']['fonts']['errors']	= $font_errors;

			//Check if the use wants pagenumbering
			$clipartElementIDs = Hash::extract($txt, 'page.{n}.area.{n}.clipart.@attributes.uniqueName');
			$clipart_counter		= 0;
			$clipart_array			= array();
			foreach($clipartElementIDs as $clipartId=>$clipartElements)
			{
				if (!isset($clipart_array[$clipartElements]))
				{
					$clipart_array[$clipartElements] = 0;
				}
				$clipart_array[$clipartElements] = $clipart_array[$clipartElements] + 1;
				$clipart_counter++;					
			}
			$return_data['ProductConversionService']['designElementID']['cliparts']['counter']	= $clipart_counter;
			$return_data['ProductConversionService']['designElementID']['cliparts']['items']	= $clipart_array;

			//Check if the use wants pagenumbering
			$pagenumbering = Hash::extract($txt, 'pagenumbering.outline.@attributes.enabled');
			$return_data['ProductConversionService']['designElementID']['pagenumbering'] 	= array('active'=>$pagenumbering[0]);

			//debug($return_data['ProductConversionService']['designElementID']);
			//debug($array_mcf_content);
			//die();
			
			$return_data['ProductConversionService']['ziplink'] = 'http://api.xhibit.com/v2/'.$array_photos[0]['path'].'download.zip';	
					
			
			//Create the zip file!
			if (!file_exists($array_photos[0]['full_path'].'download.zip'))
			{
				$this->Zip->begin($array_photos[0]['full_path'].'download.zip');
				$this->Zip->addByContent('fotoalbum.mcf', $return_data['ProductConversionService']['mcf_content']);
				foreach($array_photos as $photo)
				{
					$this->Zip->addFile($photo['full_path'].$photo['hires'],$photo['hires']);
				}
			}
			
			$this->request->data = $return_data;
			
			
		}
		//$users = $this->ProductConversionService->User->find('list');
		$productConversions = $this->ProductConversionService->ProductConversion->find('list');
		$products = $this->ProductConversionService->Product->find('list');
		$this->set(compact('users', 'productConversions', 'products'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ProductConversionService->id = $id;
		if (!$this->ProductConversionService->exists()) {
			throw new NotFoundException(__('Invalid product conversion service'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductConversionService->delete()) {
			$this->Session->setFlash(__('Product conversion service deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product conversion service was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
