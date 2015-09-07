<?php
App::uses('AppController', 'Controller');
/**
 * ProductColors Controller
 *
 * @property ProductColor $ProductColor
 * @property PaginatorComponent $Paginator
 */
class ProductColorsController extends AppController {

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
		$this->Paginator->settings = array(
				'conditions' => array(Inflector::singularize($this->name).'.printer_id' => Configure::read('Printers.shown')),
				'limit' => 25				
		);
		if ( ($this->params['named']) && (!isset($this->params['named']['page'])) && (!isset($this->params['named']['sort'])) )
		{
			$this->Paginator->settings = array(
				'conditions' => $this->params['named'],
				'limit' => 100000
			);			
			
		}			
		$this->ProductColor->recursive = 0;
		$this->set('productColors', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductColor->exists($id)) {
			throw new NotFoundException(__('Invalid product color'));
		}
		$options = array('conditions' => array('ProductColor.' . $this->ProductColor->primaryKey => $id));
		$this->set('productColor', $this->ProductColor->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductColor->create();
			if ($this->ProductColor->save($this->request->data)) {
				$this->Session->setFlash(__('The product color has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product color could not be saved. Please, try again.'));
			}
		}
		$printers = $this->ProductColor->Printer->find('list');
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
		if (!$this->ProductColor->exists($id)) {
			throw new NotFoundException(__('Invalid product color'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductColor->save($this->request->data)) {
				$this->Session->setFlash(__('The product color has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product color could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductColor.' . $this->ProductColor->primaryKey => $id));
			$this->request->data = $this->ProductColor->find('first', $options);
		}
		$printers = $this->ProductColor->Printer->find('list');
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
		$this->ProductColor->id = $id;
		if (!$this->ProductColor->exists()) {
			throw new NotFoundException(__('Invalid product color'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductColor->delete()) {
			$this->Session->setFlash(__('Product color deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product color was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
