<?php
App::uses('AppController', 'Controller');
/**
 * PrinterProductPrices Controller
 *
 * @property PrinterProductPrice $PrinterProductPrice
 * @property PaginatorComponent $Paginator
 */
class PrinterProductPricesController extends AppController {

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
		$this->PrinterProductPrice->recursive = 0;
		$this->set('printerProductPrices', $this->Paginator->paginate());
		$printerProducts = $this->PrinterProductPrice->PrinterProduct->find('list');
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
		if (!$this->PrinterProductPrice->exists($id)) {
			throw new NotFoundException(__('Invalid printer product price'));
		}
		$options = array('conditions' => array('PrinterProductPrice.' . $this->PrinterProductPrice->primaryKey => $id));
		$this->set('printerProductPrice', $this->PrinterProductPrice->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->PrinterProductPrice->create();
			if ($this->PrinterProductPrice->save($this->request->data)) {
				$this->Session->setFlash(__('The printer product price has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The printer product price could not be saved. Please, try again.'));
			}
		}
		$printerProducts = $this->PrinterProductPrice->PrinterProduct->find('list');
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
		if (!$this->PrinterProductPrice->exists($id)) {
			throw new NotFoundException(__('Invalid printer product price'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PrinterProductPrice->save($this->request->data)) {
				$this->Session->setFlash(__('The printer product price has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The printer product price could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PrinterProductPrice.' . $this->PrinterProductPrice->primaryKey => $id));
			$this->request->data = $this->PrinterProductPrice->find('first', $options);
		}
		$printerProducts = $this->PrinterProductPrice->PrinterProduct->find('list');
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
		$this->PrinterProductPrice->id = $id;
		if (!$this->PrinterProductPrice->exists()) {
			throw new NotFoundException(__('Invalid printer product price'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PrinterProductPrice->delete()) {
			$this->Session->setFlash(__('Printer product price deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Printer product price was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
