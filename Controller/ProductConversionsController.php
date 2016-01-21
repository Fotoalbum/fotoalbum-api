<?php
App::uses('AppController', 'Controller');
/**
 * ProductConversions Controller
 *
 * @property ProductConversion $ProductConversion
 * @property PaginatorComponent $Paginator
 */
class ProductConversionsController extends AppController {

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
		$this->ProductConversion->recursive = 0;
		$this->set('productConversions', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductConversion->exists($id)) {
			throw new NotFoundException(__('Invalid product conversion'));
		}
		$options = array('conditions' => array('ProductConversion.' . $this->ProductConversion->primaryKey => $id));
		$this->set('productConversion', $this->ProductConversion->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductConversion->create();
			if ($this->ProductConversion->save($this->request->data)) {
				$this->Session->setFlash(__('The product conversion has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product conversion could not be saved. Please, try again.'));
			}
		}
		$products = $this->ProductConversion->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ProductConversion->exists($id)) {
			throw new NotFoundException(__('Invalid product conversion'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductConversion->save($this->request->data)) {
				$this->Session->setFlash(__('The product conversion has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product conversion could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductConversion.' . $this->ProductConversion->primaryKey => $id));
			$this->request->data = $this->ProductConversion->find('first', $options);
		}
		$products = $this->ProductConversion->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ProductConversion->id = $id;
		if (!$this->ProductConversion->exists()) {
			throw new NotFoundException(__('Invalid product conversion'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductConversion->delete()) {
			$this->Session->setFlash(__('Product conversion deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product conversion was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
