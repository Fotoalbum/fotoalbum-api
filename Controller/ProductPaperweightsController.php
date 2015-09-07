<?php
App::uses('AppController', 'Controller');
/**
 * ProductPaperweights Controller
 *
 * @property ProductPaperweight $ProductPaperweight
 * @property PaginatorComponent $Paginator
 */
class ProductPaperweightsController extends AppController {

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
		$this->ProductPaperweight->recursive = 0;
		$this->set('productPaperweights', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductPaperweight->exists($id)) {
			throw new NotFoundException(__('Invalid product paperweight'));
		}
		$options = array('conditions' => array('ProductPaperweight.' . $this->ProductPaperweight->primaryKey => $id));
		$this->set('productPaperweight', $this->ProductPaperweight->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductPaperweight->create();
			if ($this->ProductPaperweight->save($this->request->data)) {
				$this->Session->setFlash(__('The product paperweight has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product paperweight could not be saved. Please, try again.'));
			}
		}
		$printers = $this->ProductPaperweight->Printer->find('list');
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
		if (!$this->ProductPaperweight->exists($id)) {
			throw new NotFoundException(__('Invalid product paperweight'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductPaperweight->save($this->request->data)) {
				$this->Session->setFlash(__('The product paperweight has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product paperweight could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductPaperweight.' . $this->ProductPaperweight->primaryKey => $id));
			$this->request->data = $this->ProductPaperweight->find('first', $options);
		}
		$printers = $this->ProductPaperweight->Printer->find('list');
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
		$this->ProductPaperweight->id = $id;
		if (!$this->ProductPaperweight->exists()) {
			throw new NotFoundException(__('Invalid product paperweight'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductPaperweight->delete()) {
			$this->Session->setFlash(__('Product paperweight deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product paperweight was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
