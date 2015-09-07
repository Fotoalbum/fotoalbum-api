<?php
App::uses('AppController', 'Controller');
/**
 * ProductShapes Controller
 *
 * @property ProductShape $ProductShape
 * @property PaginatorComponent $Paginator
 */
class ProductShapesController extends AppController {

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
		$this->ProductShape->recursive = 0;
		$this->set('productShapes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductShape->exists($id)) {
			throw new NotFoundException(__('Invalid product shape'));
		}
		$options = array('conditions' => array('ProductShape.' . $this->ProductShape->primaryKey => $id));
		$this->set('productShape', $this->ProductShape->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductShape->create();
			if ($this->ProductShape->save($this->request->data)) {
				$this->Session->setFlash(__('The product shape has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product shape could not be saved. Please, try again.'));
			}
		}
		$printers = $this->ProductShape->Printer->find('list');
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
		if (!$this->ProductShape->exists($id)) {
			throw new NotFoundException(__('Invalid product shape'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductShape->save($this->request->data)) {
				$this->Session->setFlash(__('The product shape has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product shape could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductShape.' . $this->ProductShape->primaryKey => $id));
			$this->request->data = $this->ProductShape->find('first', $options);
		}
		$printers = $this->ProductShape->Printer->find('list');
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
		$this->ProductShape->id = $id;
		if (!$this->ProductShape->exists()) {
			throw new NotFoundException(__('Invalid product shape'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductShape->delete()) {
			$this->Session->setFlash(__('Product shape deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product shape was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
