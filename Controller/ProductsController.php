<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class ProductsController extends AppController {

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
	public function admin_index($filter = false) {
		$this->Product->recursive = 0;
		$this->Paginator->settings = array(
			'conditions' => array('Product.status'=> 'A'),
			'limit' => 100,
			'order' => 'Product.id DESC'				
		);
		if ( ($this->params['named']) && (!isset($this->params['named']['page'])) && (!isset($this->params['named']['sort'])) )
		{
			$this->Paginator->settings = array(
				'conditions' => $this->params['named'],
				'limit' => 100000
			);			
			
		}	
		$this->set('products', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		}

		$printer_hidden_conditions = array('conditions'=>array('printer_id'=>Configure::read('Printers.shown')));

		$productPaperweights = $this->Product->ProductPaperweight->find('list',$printer_hidden_conditions);
		$productPapertypes = $this->Product->ProductPapertype->find('list',$printer_hidden_conditions);

		$parentProducts = $this->Product->ParentProduct->find('list');
		$parentProducts[0] = 'Geen';
		ksort($parentProducts);
				
		$productCovers = $this->Product->ProductCover->find('list', array_merge($printer_hidden_conditions,array('fields'=>array('id','name'))));
		$productCovers[0] = 'None';
		ksort($productCovers);
		
		$productSizes = $this->Product->ProductSize->find('list',$printer_hidden_conditions);
		$productSizes[0] = 'None';
		ksort($productSizes);
		
		$productShapes = $this->Product->ProductShape->find('list',$printer_hidden_conditions);
		$productShapes[0] = 'None';
		ksort($productShapes);
		
		$productColors = $this->Product->ProductColor->find('list',$printer_hidden_conditions);
		$productColors[0] = 'None';
		ksort($productColors);				
		
		$categories = $this->Product->Category->generateTreeList(array('Category.model'=>'Product'),NULL,NULL,'-- ');

		if (count($categories) <= 0)
		{
			$categories = array(
				'NULL'=>'Geen',
				'5368d3ad-a1a4-4be4-8bf6-40160a01bb0e'=>'Fotoalbum'
			);
		}
		$this->set(compact(
							'categories',
							'parentProducts',
							'productPaperweights',
							'productPapertypes',
							'productCovers',
							'productSizes',
							'productShapes',
							'productColors'
						)
					);
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
		$printer_hidden_conditions = array('conditions'=>array('printer_id'=>Configure::read('Printers.shown')));

		$productPaperweights = $this->Product->ProductPaperweight->find('list',$printer_hidden_conditions);
		$productPapertypes = $this->Product->ProductPapertype->find('list',$printer_hidden_conditions);

		$parentProducts = $this->Product->ParentProduct->find('list');
		$parentProducts[0] = 'Geen';
		ksort($parentProducts);
				
		$productCovers = $this->Product->ProductCover->find('list', array_merge($printer_hidden_conditions,array('fields'=>array('id','name'))));
		$productCovers[0] = 'None';
		ksort($productCovers);
		
		$productSizes = $this->Product->ProductSize->find('list',$printer_hidden_conditions);
		$productSizes[0] = 'None';
		ksort($productSizes);
		
		$productShapes = $this->Product->ProductShape->find('list',$printer_hidden_conditions);
		$productShapes[0] = 'None';
		ksort($productShapes);
		
		$productColors = $this->Product->ProductColor->find('list',$printer_hidden_conditions);
		$productColors[0] = 'None';
		ksort($productColors);					
		
		$categories = $this->Product->Category->generateTreeList(array('Category.model'=>'Product'),NULL,NULL,'-- ');
		$this->set(compact(
							'categories',
							'parentProducts',
							'productPaperweights',
							'productPapertypes',
							'productCovers',
							'productSizes',
							'productShapes',
							'productColors'
						)
					);
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('Product deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
