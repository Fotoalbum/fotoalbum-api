<?php
App::uses('AppController', 'Controller');
/**
 * ProductSizes Controller
 *
 * @property ProductSize $ProductSize
 * @property PaginatorComponent $Paginator
 */
class ProductSizesController extends AppController {

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
		$this->ProductSize->recursive = 0;
		$this->set('productSizes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductSize->exists($id)) {
			throw new NotFoundException(__('Invalid product size'));
		}
		$options = array('conditions' => array('ProductSize.' . $this->ProductSize->primaryKey => $id));
		$this->set('productSize', $this->ProductSize->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductSize->create();
			if ($this->ProductSize->save($this->request->data)) {
				$this->Session->setFlash(__('The product size has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product size could not be saved. Please, try again.'));
			}
		}
		$printers = $this->ProductSize->Printer->find('list');
		$this->set(compact('printers'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ProductSize->exists($id)) {
			throw new NotFoundException(__('Invalid product size'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductSize->save($this->request->data)) {
				$this->Session->setFlash(__('The product size has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product size could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductSize.' . $this->ProductSize->primaryKey => $id));
			$this->request->data = $this->ProductSize->find('first', $options);
		}
		$printers = $this->ProductSize->Printer->find('list');
		$this->set(compact('printers'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ProductSize->id = $id;
		if (!$this->ProductSize->exists()) {
			throw new NotFoundException(__('Invalid product size'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductSize->delete()) {
			$this->Session->setFlash(__('Product size deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product size was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
