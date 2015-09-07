<?php
App::uses('AppController', 'Controller');
/**
 * ProductCovers Controller
 *
 * @property ProductCover $ProductCover
 * @property PaginatorComponent $Paginator
 */
class ProductCoversController extends AppController {

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
		$this->ProductCover->recursive = 0;
		$this->set('productCovers', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductCover->exists($id)) {
			throw new NotFoundException(__('Invalid product cover'));
		}
		$options = array('conditions' => array('ProductCover.' . $this->ProductCover->primaryKey => $id));
		$this->set('productCover', $this->ProductCover->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductCover->create();
			if ($this->ProductCover->save($this->request->data)) {
				$this->Session->setFlash(__('The product cover has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product cover could not be saved. Please, try again.'));
			}
		}
		$products = $this->ProductCover->Product->find('list');
		$productPaperweights = $this->ProductCover->ProductPaperweight->find('list');
		$productPapertypes = $this->ProductCover->ProductPapertype->find('list');
		$productFinishes = $this->ProductCover->ProductFinish->find('list');
		
		$this->set(compact('products','productPaperweights', 'productPapertypes', 'productFinishes'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ProductCover->exists($id)) {
			throw new NotFoundException(__('Invalid product cover'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductCover->save($this->request->data)) {
				$this->Session->setFlash(__('The product cover has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product cover could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductCover.' . $this->ProductCover->primaryKey => $id));
			$this->request->data = $this->ProductCover->find('first', $options);
		}
		$products = $this->ProductCover->Product->find('list');
		$productPaperweights = $this->ProductCover->ProductPaperweight->find('list');
		$productPapertypes = $this->ProductCover->ProductPapertype->find('list');
		$productFinishes = $this->ProductCover->ProductFinish->find('list');
		
		$this->set(compact('products','productPaperweights', 'productPapertypes', 'productFinishes'));		

	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ProductCover->id = $id;
		if (!$this->ProductCover->exists()) {
			throw new NotFoundException(__('Invalid product cover'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductCover->delete()) {
			$this->Session->setFlash(__('Product cover deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product cover was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
