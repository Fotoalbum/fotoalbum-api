<?php
App::uses('AppController', 'Controller');
/**
 * Backgrounds Controller
 *
 * @property Background $Background
 * @property PaginatorComponent $Paginator
 */
class BackgroundsController extends AppController {

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
		$this->Background->recursive = 0;
		$this->set('backgrounds', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Background->exists($id)) {
			throw new NotFoundException(__('Invalid background'));
		}
		$options = array('conditions' => array('Background.' . $this->Background->primaryKey => $id));
		$this->set('background', $this->Background->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Background->create();
			if ($this->Background->save($this->request->data)) {
				$this->Session->setFlash(__('The background has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The background could not be saved. Please, try again.'));
			}
		}
		$categories = $this->Background->Category->find('list');
		$styles = $this->Background->Style->find('list');
		$types = $this->Background->Type->find('list');
		$this->set(compact('categories', 'styles', 'types'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Background->exists($id)) {
			throw new NotFoundException(__('Invalid background'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Background->save($this->request->data)) {
				$this->Session->setFlash(__('The background has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The background could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Background.' . $this->Background->primaryKey => $id));
			$this->request->data = $this->Background->find('first', $options);
		}
		$categories = $this->Background->Category->find('list');
		$styles = $this->Background->Style->find('list');
		$types = $this->Background->Type->find('list', array('conditions'=>array('foreign_model'=>'Background')));
		$this->set(compact('categories', 'styles', 'types'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Background->id = $id;
		if (!$this->Background->exists()) {
			throw new NotFoundException(__('Invalid background'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Background->delete()) {
			$this->Session->setFlash(__('Background deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Background was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
