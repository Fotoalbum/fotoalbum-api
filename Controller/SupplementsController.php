<?php
App::uses('AppController', 'Controller');
/**
 * Supplements Controller
 *
 * @property Supplement $Supplement
 * @property PaginatorComponent $Paginator
 */
class SupplementsController extends AppController {

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
		$this->Supplement->recursive = 0;
		$this->set('supplements', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Supplement->exists($id)) {
			throw new NotFoundException(__('Invalid supplement'));
		}
		$options = array('conditions' => array('Supplement.' . $this->Supplement->primaryKey => $id));
		$this->set('supplement', $this->Supplement->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Supplement->create();
			if ($this->Supplement->save($this->request->data)) {
				$this->Session->setFlash(__('The supplement has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplement could not be saved. Please, try again.'));
			}
		}
		$parentSupplements = $this->Supplement->ParentSupplement->find('list');
		$categories = $this->Supplement->Category->find('list');
		$printers = $this->Supplement->Printer->find('list');
		$this->set(compact('parentSupplements', 'categories', 'printers'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Supplement->exists($id)) {
			throw new NotFoundException(__('Invalid supplement'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Supplement->save($this->request->data)) {
				$this->Session->setFlash(__('The supplement has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplement could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Supplement.' . $this->Supplement->primaryKey => $id));
			$this->request->data = $this->Supplement->find('first', $options);
		}
		$parentSupplements = $this->Supplement->find('list');
		$categories = $this->Supplement->Category->find('list');
		$printers = $this->Supplement->Printer->find('list');
		$this->set(compact('parentSupplements', 'categories', 'printers'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Supplement->id = $id;
		if (!$this->Supplement->exists()) {
			throw new NotFoundException(__('Invalid supplement'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Supplement->delete()) {
			$this->Session->setFlash(__('Supplement deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Supplement was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
