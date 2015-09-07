<?php
App::uses('AppController', 'Controller');
/**
 * ProductSingles Controller
 *
 * @property ProductSingle $ProductSingle
 * @property PaginatorComponent $Paginator
 */
class ProductSinglesController extends AppController {

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
		$this->ProductSingle->recursive = 0;
		$products = $this->ProductSingle->Product->find('list');
		$productSingles = $this->Paginator->paginate();
		$this->set(compact('productSingles','products'));		
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductSingle->exists($id)) {
			throw new NotFoundException(__('Invalid product single'));
		}
		$products = $this->ProductSingle->Product->find('list');
		$options = array('conditions' => array('ProductSingle.' . $this->ProductSingle->primaryKey => $id));
		$productSingle = $this->ProductSingle->find('first', $options);
		$this->set(compact('productSingle','products'));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductSingle->create();
			if ($this->ProductSingle->save($this->request->data)) {
				$this->Session->setFlash(__('The product single has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product single could not be saved. Please, try again.'));
			}
		}
		$products = $this->ProductSingle->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ProductSingle->exists($id)) {
			throw new NotFoundException(__('Invalid product single'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductSingle->save($this->request->data)) {
				$this->Session->setFlash(__('The product single has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product single could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductSingle.' . $this->ProductSingle->primaryKey => $id));
			$this->request->data = $this->ProductSingle->find('first', $options);
		}
		$products = $this->ProductSingle->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ProductSingle->id = $id;
		if (!$this->ProductSingle->exists()) {
			throw new NotFoundException(__('Invalid product single'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductSingle->delete()) {
			$this->Session->setFlash(__('Product single deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product single was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
