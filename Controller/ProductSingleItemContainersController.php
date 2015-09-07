<?php
App::uses('AppController', 'Controller');
/**
 * ProductSingleItemContainers Controller
 *
 * @property ProductSingleItemContainer $ProductSingleItemContainer
 * @property PaginatorComponent $Paginator
 */
class ProductSingleItemContainersController extends AppController {

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
		$this->ProductSingleItemContainer->recursive = 0;
		$this->set('productSingleItemContainers', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductSingleItemContainer->exists($id)) {
			throw new NotFoundException(__('Invalid product single item container'));
		}
		$options = array('conditions' => array('ProductSingleItemContainer.' . $this->ProductSingleItemContainer->primaryKey => $id));
		$this->set('productSingleItemContainer', $this->ProductSingleItemContainer->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductSingleItemContainer->create();
			if ($this->ProductSingleItemContainer->save($this->request->data)) {
				$this->Session->setFlash(__('The product single item container has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product single item container could not be saved. Please, try again.'));
			}
		}
		$productSingleItems = $this->ProductSingleItemContainer->ProductSingleItem->find('list');
		$this->set(compact('productSingleItems'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ProductSingleItemContainer->exists($id)) {
			throw new NotFoundException(__('Invalid product single item container'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductSingleItemContainer->save($this->request->data)) {
				$this->Session->setFlash(__('The product single item container has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product single item container could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductSingleItemContainer.' . $this->ProductSingleItemContainer->primaryKey => $id));
			$this->request->data = $this->ProductSingleItemContainer->find('first', $options);
		}
		$productSingleItems = $this->ProductSingleItemContainer->ProductSingleItem->find('list');
		$this->set(compact('productSingleItems'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ProductSingleItemContainer->id = $id;
		if (!$this->ProductSingleItemContainer->exists()) {
			throw new NotFoundException(__('Invalid product single item container'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductSingleItemContainer->delete()) {
			$this->Session->setFlash(__('Product single item container deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product single item container was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
