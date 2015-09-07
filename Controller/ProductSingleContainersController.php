<?php
App::uses('AppController', 'Controller');
/**
 * ProductSingleContainers Controller
 *
 * @property ProductSingleContainer $ProductSingleContainer
 * @property PaginatorComponent $Paginator
 */
class ProductSingleContainersController extends AppController {

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
		$this->ProductSingleContainer->recursive = 0;
		$this->set('productSingleContainers', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductSingleContainer->exists($id)) {
			throw new NotFoundException(__('Invalid product single container'));
		}
		$options = array('conditions' => array('ProductSingleContainer.' . $this->ProductSingleContainer->primaryKey => $id));
		$this->set('productSingleContainer', $this->ProductSingleContainer->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductSingleContainer->create();
			if ($this->ProductSingleContainer->save($this->request->data)) {
				$this->Session->setFlash(__('The product single container has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product single container could not be saved. Please, try again.'));
			}
		}
		$productSingles = $this->ProductSingleContainer->ProductSingle->find('list', array('fields'=>array('id','selectname')));
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
		if (!$this->ProductSingleContainer->exists($id)) {
			throw new NotFoundException(__('Invalid product single container'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductSingleContainer->save($this->request->data)) {
				$this->Session->setFlash(__('The product single container has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product single container could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductSingleContainer.' . $this->ProductSingleContainer->primaryKey => $id));
			$this->request->data = $this->ProductSingleContainer->find('first', $options);
		}
		$productSingles = $this->ProductSingleContainer->ProductSingle->find('list', array('fields'=>array('id','selectname')));
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
		$this->ProductSingleContainer->id = $id;
		if (!$this->ProductSingleContainer->exists()) {
			throw new NotFoundException(__('Invalid product single container'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductSingleContainer->delete()) {
			$this->Session->setFlash(__('Product single container deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product single container was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
