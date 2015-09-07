<?php
App::uses('AppController', 'Controller');
/**
 * ProductPapertypes Controller
 *
 * @property ProductPapertype $ProductPapertype
 * @property PaginatorComponent $Paginator
 */
class ProductPapertypesController extends AppController {

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
		$this->ProductPapertype->recursive = 0;
		$this->set('productPapertypes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductPapertype->exists($id)) {
			throw new NotFoundException(__('Invalid product papertype'));
		}
		$options = array('conditions' => array('ProductPapertype.' . $this->ProductPapertype->primaryKey => $id));
		$this->set('productPapertype', $this->ProductPapertype->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductPapertype->create();
			if ($this->ProductPapertype->save($this->request->data)) {
				$this->Session->setFlash(__('The product papertype has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product papertype could not be saved. Please, try again.'));
			}
		}
		$printers = $this->ProductPapertype->Printer->find('list');
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
		if (!$this->ProductPapertype->exists($id)) {
			throw new NotFoundException(__('Invalid product papertype'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductPapertype->save($this->request->data)) {
				$this->Session->setFlash(__('The product papertype has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product papertype could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductPapertype.' . $this->ProductPapertype->primaryKey => $id));
			$this->request->data = $this->ProductPapertype->find('first', $options);
		}
		$printers = $this->ProductPapertype->Printer->find('list');
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
		$this->ProductPapertype->id = $id;
		if (!$this->ProductPapertype->exists()) {
			throw new NotFoundException(__('Invalid product papertype'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductPapertype->delete()) {
			$this->Session->setFlash(__('Product papertype deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product papertype was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
