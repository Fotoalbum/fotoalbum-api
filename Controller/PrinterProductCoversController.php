<?php
App::uses('AppController', 'Controller');
/**
 * PrinterProductCovers Controller
 *
 * @property PrinterProductCover $PrinterProductCover
 * @property PaginatorComponent $Paginator
 */
class PrinterProductCoversController extends AppController {

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
		$this->PrinterProductCover->recursive = 0;
		$this->set('printerProductCovers', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->PrinterProductCover->exists($id)) {
			throw new NotFoundException(__('Invalid printer product cover'));
		}
		$options = array('conditions' => array('PrinterProductCover.' . $this->PrinterProductCover->primaryKey => $id));
		$this->set('printerProductCover', $this->PrinterProductCover->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->PrinterProductCover->create();
			if ($this->PrinterProductCover->save($this->request->data)) {
				$this->Session->setFlash(__('The printer product cover has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The printer product cover could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->PrinterProductCover->exists($id)) {
			throw new NotFoundException(__('Invalid printer product cover'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PrinterProductCover->save($this->request->data)) {
				$this->Session->setFlash(__('The printer product cover has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The printer product cover could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PrinterProductCover.' . $this->PrinterProductCover->primaryKey => $id));
			$this->request->data = $this->PrinterProductCover->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->PrinterProductCover->id = $id;
		if (!$this->PrinterProductCover->exists()) {
			throw new NotFoundException(__('Invalid printer product cover'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PrinterProductCover->delete()) {
			$this->Session->setFlash(__('Printer product cover deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Printer product cover was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
