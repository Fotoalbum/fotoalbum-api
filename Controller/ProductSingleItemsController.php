<?php
App::uses('AppController', 'Controller');
/**
 * ProductSingleItems Controller
 *
 * @property ProductSingleItem $ProductSingleItem
 * @property PaginatorComponent $Paginator
 */
class ProductSingleItemsController extends AppController {

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
		$this->ProductSingleItem->recursive = 0;
		$productSingles = $this->ProductSingleItem->ProductSingle->find('list');
		$this->set('productSingles', $productSingles);
		$this->set('productSingleItems', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductSingleItem->exists($id)) {
			throw new NotFoundException(__('Invalid product single item'));
		}
		$options = array('conditions' => array('ProductSingleItem.' . $this->ProductSingleItem->primaryKey => $id));
		$this->set('productSingleItem', $this->ProductSingleItem->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductSingleItem->create();
			if ($this->ProductSingleItem->save($this->request->data)) {
				$this->Session->setFlash(__('The product single item has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product single item could not be saved. Please, try again.'));
			}
		}
		$productSingles = $this->ProductSingleItem->ProductSingle->find('list', array('fields'=>array('id','selectname')));
		$this->set(compact('productSingles'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ProductSingleItem->exists($id)) {
			throw new NotFoundException(__('Invalid product single item'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductSingleItem->save($this->request->data)) {
				$this->Session->setFlash(__('The product single item has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product single item could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductSingleItem.' . $this->ProductSingleItem->primaryKey => $id));
			$this->request->data = $this->ProductSingleItem->find('first', $options);
		}
		$productSingles = $this->ProductSingleItem->ProductSingle->find('list');
		$this->set(compact('productSingles'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ProductSingleItem->id = $id;
		if (!$this->ProductSingleItem->exists()) {
			throw new NotFoundException(__('Invalid product single item'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductSingleItem->delete()) {
			$this->Session->setFlash(__('Product single item deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product single item was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
