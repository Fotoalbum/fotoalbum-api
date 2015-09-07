<?php
App::uses('AppController', 'Controller');
/**
 * ProductSupplements Controller
 *
 * @property ProductSupplement $ProductSupplement
 * @property PaginatorComponent $Paginator
 */
class ProductSupplementsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	 public $paginate = array(
			'limit' => 50,
			'group' => array(
				'ProductSupplement.supplement_id'
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
		$this->ProductSupplement->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->set('productSupplements', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductSupplement->exists($id)) {
			throw new NotFoundException(__('Invalid product supplement'));
		}
		$options = array('conditions' => array('ProductSupplement.' . $this->ProductSupplement->primaryKey => $id));
		$this->set('productSupplement', $this->ProductSupplement->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$supplement_id 	= $this->request->data['ProductSupplement']['supplement_id'];
			$this->ProductSupplement->deleteAll(array('ProductSupplement.supplement_id' => $supplement_id), false);

			$product_ids = $this->request->data['ProductSupplement']['product_id'];
			if (!is_array($product_ids))
			{
				$product_ids = array($this->request->data['ProductSupplement']['product_id']);

			}
			$result			= 0;
			foreach($product_ids as $product_id)
			{
				$this->ProductSupplement->create();
				$saveData = array(
								'ProductSupplement' => array(
									'supplement_id'=>$supplement_id,
									'product_id'=>$product_id
								)
							);	
								
				if ($this->ProductSupplement->save($saveData))
				{
					$result++;
				}
			}
			if (count($product_ids) == $result) {
				$this->Session->setFlash(__('The product supplement has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product supplement could not be saved. Please, try again.'));
			}					
		}
		$products = $this->ProductSupplement->Product->find('list');
		$supplements = $this->ProductSupplement->Supplement->find('list');
		$this->set(compact('products', 'supplements'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {

		if ($this->request->is('post') || $this->request->is('put')) {
			$supplement_id 	= $this->request->data['ProductSupplement']['supplement_id'];
			$this->ProductSupplement->deleteAll(array('ProductSupplement.supplement_id' => $supplement_id), false);

			$product_ids = $this->request->data['ProductSupplement']['product_id'];
			if (!is_array($product_ids))
			{
				$product_ids = array($this->request->data['ProductSupplement']['product_id']);

			}
			$result			= 0;
			foreach($product_ids as $product_id)
			{
				$this->ProductSupplement->create();
				$saveData = array(
								'ProductSupplement' => array(
									'supplement_id'=>$supplement_id,
									'product_id'=>$product_id
								)
							);	
								
				if ($this->ProductSupplement->save($saveData))
				{
					$result++;
				}
			}
			if (count($product_ids) == $result) {
				$this->Session->setFlash(__('The product supplement has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product supplement could not be saved. Please, try again.'));
			}					

		} else {
			$options = array('recursive'=>-1, 'conditions' => array('ProductSupplement.supplement_id' => $id));
			/*
			$this->request->data = $this->ProductSupplement->find('all', $options);
			*/
			$request_data = $this->ProductSupplement->find('all', $options);
			$request_data['ProductSupplement']['supplement_id']	= $id;
			$request_data['ProductSupplement']['product_id']	= Hash::extract($request_data,'{n}.ProductSupplement.product_id');			
			$this->request->data = $request_data;
			
			
		}
		$products = $this->ProductSupplement->Product->find('list');
		$supplements = $this->ProductSupplement->Supplement->find('list');
		
		$this->set(compact('products', 'supplements'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ProductSupplement->id = $id;
		if (!$this->ProductSupplement->exists()) {
			throw new NotFoundException(__('Invalid product supplement'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductSupplement->delete()) {
			$this->Session->setFlash(__('Product supplement deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product supplement was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
