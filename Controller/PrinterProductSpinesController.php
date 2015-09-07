<?php
App::uses('AppController', 'Controller');
/**
 * PrinterProductSpines Controller
 *
 * @property PrinterProductSpine $PrinterProductSpine
 * @property PaginatorComponent $Paginator
 */
class PrinterProductSpinesController extends AppController {

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
		$this->PrinterProductSpine->recursive = 0;
		$this->set('printerProductSpines', $this->Paginator->paginate());
		$printerProducts = $this->PrinterProductSpine->PrinterProduct->find('list');
		$this->set(compact('printerProducts'));		
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->PrinterProductSpine->exists($id)) {
			throw new NotFoundException(__('Invalid printer product spine'));
		}
		$options = array('conditions' => array('PrinterProductSpine.' . $this->PrinterProductSpine->primaryKey => $id));
		$this->set('printerProductSpine', $this->PrinterProductSpine->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->PrinterProductSpine->create();
			if ($this->PrinterProductSpine->save($this->request->data)) {
				$this->Session->setFlash(__('The printer product spine has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The printer product spine could not be saved. Please, try again.'));
			}
		}
		$printerProducts = $this->PrinterProductSpine->PrinterProduct->find('list');
		$this->set(compact('printerProducts'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->PrinterProductSpine->exists($id)) {
			throw new NotFoundException(__('Invalid printer product spine'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PrinterProductSpine->save($this->request->data)) {
				$this->Session->setFlash(__('The printer product spine has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The printer product spine could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PrinterProductSpine.' . $this->PrinterProductSpine->primaryKey => $id));
			$this->request->data = $this->PrinterProductSpine->find('first', $options);
		}
		$printerProducts = $this->PrinterProductSpine->PrinterProduct->find('list');
		$this->set(compact('printerProducts'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->PrinterProductSpine->id = $id;
		if (!$this->PrinterProductSpine->exists()) {
			throw new NotFoundException(__('Invalid printer product spine'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PrinterProductSpine->delete()) {
			$this->Session->setFlash(__('Printer product spine deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Printer product spine was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
