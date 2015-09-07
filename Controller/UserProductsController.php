<?php
App::uses('AppController', 'Controller');
/**
 * UserProducts Controller
 *
 * @property UserProduct $UserProduct
 * @property PaginatorComponent $Paginator
 */
class UserProductsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
	//public $uses = array('Users.User','UserProduct');

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
		$this->UserProduct->recursive = 0;
		$this->set('userProducts', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->UserProduct->exists($id)) {
			throw new NotFoundException(__('Invalid user product'));
		}
		$options = array('conditions' => array('UserProduct.' . $this->UserProduct->primaryKey => $id));
		$userProduct = $this->UserProduct->find('first', $options);
		$this->set('userProduct', $userProduct);
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->UserProduct->create();
			if ($this->UserProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The user product has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user product could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserProduct->User->find('list');
		$products = $this->UserProduct->Product->find('list');
		$this->set(compact('users', 'products'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->UserProduct->exists($id)) {
			throw new NotFoundException(__('Invalid user product'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The user product has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserProduct.' . $this->UserProduct->primaryKey => $id));
			$this->request->data = $this->UserProduct->find('first', $options);
		}
		$users = $this->UserProduct->User->find('list');
		$products = $this->UserProduct->Product->find('list');
		$this->set(compact('users', 'products'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->UserProduct->id = $id;
		if (!$this->UserProduct->exists()) {
			throw new NotFoundException(__('Invalid user product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserProduct->delete()) {
			$this->Session->setFlash(__('User product deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User product was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
