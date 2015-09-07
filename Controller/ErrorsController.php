<?php
App::uses('AppController', 'Controller');
/**
 * Errors Controller
 *
 * @property Error $Error
 * @property PaginatorComponent $Paginator
 */
class ErrorsController extends AppController {

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
		$this->Error->recursive = 0;
		$this->set('errors', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Error->exists($id)) {
			throw new NotFoundException(__('Invalid error'));
		}
		$options = array('conditions' => array('Error.' . $this->Error->primaryKey => $id));
		$this->set('error', $this->Error->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Error->create();
			if ($this->Error->save($this->request->data)) {
				$this->Session->setFlash(__('The error has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The error could not be saved. Please, try again.'));
			}
		}
		$users = $this->Error->User->find('list');
		$products = $this->Error->Product->find('list');
		$userProducts = $this->Error->UserProduct->find('list');
		$this->set(compact('users', 'products', 'userProducts'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Error->exists($id)) {
			throw new NotFoundException(__('Invalid error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Error->save($this->request->data)) {
				$this->Session->setFlash(__('The error has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The error could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Error.' . $this->Error->primaryKey => $id));
			$this->request->data = $this->Error->find('first', $options);
		}
		$users = $this->Error->User->find('list');
		$products = $this->Error->Product->find('list');
		$userProducts = $this->Error->UserProduct->find('list');
		$this->set(compact('users', 'products', 'userProducts'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Error->id = $id;
		if (!$this->Error->exists()) {
			throw new NotFoundException(__('Invalid error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Error->delete()) {
			$this->Session->setFlash(__('Error deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Error was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
