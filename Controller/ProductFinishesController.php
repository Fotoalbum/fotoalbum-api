<?php
App::uses('AppController', 'Controller');
/**
 * ProductFinishes Controller
 *
 * @property ProductFinish $ProductFinish
 * @property PaginatorComponent $Paginator
 */
class ProductFinishesController extends AppController {

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
		$this->ProductFinish->recursive = 0;
		$this->set('productFinishes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductFinish->exists($id)) {
			throw new NotFoundException(__('Invalid product finish'));
		}
		$options = array('conditions' => array('ProductFinish.' . $this->ProductFinish->primaryKey => $id));
		$this->set('productFinish', $this->ProductFinish->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductFinish->create();
			if ($this->ProductFinish->save($this->request->data)) {
				$this->Session->setFlash(__('The product finish has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product finish could not be saved. Please, try again.'));
			}
		}
		$printers = $this->ProductFinish->Printer->find('list');
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
		if (!$this->ProductFinish->exists($id)) {
			throw new NotFoundException(__('Invalid product finish'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductFinish->save($this->request->data)) {
				$this->Session->setFlash(__('The product finish has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product finish could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductFinish.' . $this->ProductFinish->primaryKey => $id));
			$this->request->data = $this->ProductFinish->find('first', $options);
		}
		$printers = $this->ProductFinish->Printer->find('list');
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
		$this->ProductFinish->id = $id;
		if (!$this->ProductFinish->exists()) {
			throw new NotFoundException(__('Invalid product finish'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductFinish->delete()) {
			$this->Session->setFlash(__('Product finish deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product finish was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
