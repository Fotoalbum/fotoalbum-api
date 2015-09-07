<?php
App::uses('AppController', 'Controller');
/**
 * PrinterProducts Controller
 *
 * @property PrinterProduct $PrinterProduct
 * @property PaginatorComponent $Paginator
 */
class PrinterProductsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

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
		$this->Paginator->settings = array(
				'conditions' => array(Inflector::singularize($this->name).'.printer_id' => Configure::read('Printers.shown')),
				'limit' => 25				
		);
		if ( ($this->params['named']) && (!isset($this->params['named']['page'])) && (!isset($this->params['named']['sort'])) )
		{
			$this->Paginator->settings = array(
				'conditions' => $this->params['named'],
				'limit' => 100000
			);			
			
		}
		$this->PrinterProduct->recursive = 0;
		$this->set('printerProducts', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->PrinterProduct->exists($id)) {
			throw new NotFoundException(__('Invalid printer product'));
		}
		$options = array('conditions' => array('PrinterProduct.' . $this->PrinterProduct->primaryKey => $id));
		$this->set('printerProduct', $this->PrinterProduct->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->PrinterProduct->create();
			if ($this->PrinterProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The printer product has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The printer product could not be saved. Please, try again.'));
			}
		}
		$products = $this->PrinterProduct->Product->find('list');
		$printers = $this->PrinterProduct->Printer->find('list');
		$printerProductCovers = $this->PrinterProduct->PrinterProductCover->find('list');
		$printerProductCovers[0] = 'None';
		ksort($printerProductCovers);		
		$productCovers = $this->PrinterProduct->ProductCover->find('list');
		$productCovers[0] = 'None';
		ksort($productCovers);
		$this->set(compact('products', 'printers', 'productCovers','printerProductCovers'));
	}
	
	
	public function admin_copy($id)
	{
		$this->PrinterProduct->copy($id);
		$this->redirect(array('action' => 'edit', $this->PrinterProduct->id));
	}
	
	public function admin_addspine()
	{
		$all_printer_products = $this->PrinterProduct->find('all');
		$hc_array = $sc_array = $st_array = array();
		foreach($all_printer_products as $all_printer_product)
		{
			if ($all_printer_product['Product']['category_id'] == '5368d3ad-a1a4-4be4-8bf6-40160a01bb0e')
			{
				if (!isset($all_printer_product['PrinterProductSpine'][0]['id']))
				{
					if (stristr($all_printer_product['PrinterProduct']['name'],'hardcover'))
					{
						$hc_array[$all_printer_product['PrinterProduct']['id']] = $all_printer_product['PrinterProduct']['product_id'];
					}
					if (stristr($all_printer_product['PrinterProduct']['name'],'geniet'))
					{
						$st_array[$all_printer_product['PrinterProduct']['id']] = $all_printer_product['PrinterProduct']['product_id'];
					}
					if (stristr($all_printer_product['PrinterProduct']['name'],'softcover'))
					{
						$sc_array[$all_printer_product['PrinterProduct']['id']] = $all_printer_product['PrinterProduct']['product_id'];
					}
				}
			}
		}
		$this->autoRender 	= false;
		//$hardcover_array	= array(314,67,315,68,45,43,46,44,34,13,35,20,26,14,27,21,23,10,24,19,32,65,31,30,317,70,318,71,50,49,52,51,56,55,58,57);
		//$stapled_array		= array(330,332);
		//$softcover_array	= array(313,66,2215,48,47,320,36,28,331,319,7,33,8,316,69,54,53,60,72);

		//$hc_array = $this->PrinterProduct->find('list', array('conditions'=>array('PrinterProduct.product_id'=>$hardcover_array), 'fields'=>array('PrinterProduct.id','PrinterProduct.product_id')));
		foreach($hc_array as $hc_id=>$product_id)
		{
			$start 	= 24;
			$end	= 36;
			$item	= 6;
			
			for ($i=0;$i<10;$i++)
			{
				echo 	"INSERT INTO `xhibit_2_0`.`xhibit_printer_product_spines` (`id`, `printer_product_id`, `min_page`, `max_page`, `value`, `base_value`, `method`, `created`, `modified`) VALUES ('NULL', '".$hc_id."', '".$start."', '".$end."', '".$item."', '0', '1', NOW(), NULL);<br/>";
				$start	= $end+1;
				$end 	= $end+24;
				$item	= $item+2;
			}
		}
		//$sc_array = $this->PrinterProduct->find('list', array('conditions'=>array('PrinterProduct.product_id'=>$softcover_array), 'fields'=>array('PrinterProduct.id','PrinterProduct.product_id')));		
		foreach($sc_array as $sc_id=>$product_id)
		{
			echo 	"INSERT INTO `xhibit_2_0`.`xhibit_printer_product_spines` (`id`, `printer_product_id`, `min_page`, `max_page`, `value`, `base_value`, `method`, `created`, `modified`) VALUES ('NULL', '".$sc_id."', '24', '200', '0.0995', '0.8', '4', NOW(), NULL);<br/>";
		}
		//$st_array = $this->PrinterProduct->find('list', array('conditions'=>array('PrinterProduct.product_id'=>$stapled_array), 'fields'=>array('PrinterProduct.id','PrinterProduct.product_id')));		
		foreach($st_array as $st_id=>$product_id)
		{
			echo 	"INSERT INTO `xhibit_2_0`.`xhibit_printer_product_spines` (`id`, `printer_product_id`, `min_page`, `max_page`, `value`, `base_value`, `method`, `created`, `modified`) VALUES ('NULL', '".$st_id."', '24', '70', '0.0001', '0', '1', NOW(), NULL);<br/>";
		}		
		die();		
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->PrinterProduct->exists($id)) {
			throw new NotFoundException(__('Invalid printer product'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PrinterProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The printer product has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The printer product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PrinterProduct.' . $this->PrinterProduct->primaryKey => $id));
			$this->request->data = $this->PrinterProduct->find('first', $options);
		}
		$products = $this->PrinterProduct->Product->find('list');
		$printers = $this->PrinterProduct->Printer->find('list');
		$printerProductCovers = $this->PrinterProduct->PrinterProductCover->find('list');
		$printerProductCovers[0] = 'None';
		ksort($printerProductCovers);		
		$productCovers = $this->PrinterProduct->ProductCover->find('list');
		$productCovers[0] = 'None';
		ksort($productCovers);
		$this->set(compact('products', 'printers', 'productCovers','printerProductCovers'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->PrinterProduct->id = $id;
		if (!$this->PrinterProduct->exists()) {
			throw new NotFoundException(__('Invalid printer product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PrinterProduct->delete()) {
			$this->Session->setFlash(__('Printer product deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Printer product was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
