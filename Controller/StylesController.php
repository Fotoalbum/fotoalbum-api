<?php
App::uses('AppController', 'Controller');
/**
 * Styles Controller
 *
 * @property Style $Style
 * @property PaginatorComponent $Paginator
 */
class StylesController extends AppController {

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
		$this->Style->recursive = 0;
		$this->set('styles', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Style->exists($id)) {
			throw new NotFoundException(__('Invalid style'));
		}
		$options = array('conditions' => array('Style.' . $this->Style->primaryKey => $id));
		$this->set('style', $this->Style->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Style->create();
			if ($this->Style->save($this->request->data)) {
				$this->Session->setFlash(__('The style has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The style could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Style->exists($id)) {
			throw new NotFoundException(__('Invalid style'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Style->save($this->request->data)) {
				$this->Session->setFlash(__('The style has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The style could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Style.' . $this->Style->primaryKey => $id));
			$this->request->data = $this->Style->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Style->id = $id;
		if (!$this->Style->exists()) {
			throw new NotFoundException(__('Invalid style'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Style->delete()) {
			$this->Session->setFlash(__('Style deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Style was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
