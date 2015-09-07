<?php
App::uses('AppController', 'Controller');
/**
 * Fonts Controller
 *
 * @property Font $Font
 * @property PaginatorComponent $Paginator
 */
class FontsController extends AppController {

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
		$this->Font->recursive = 0;
		$this->set('fonts', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Font->exists($id)) {
			throw new NotFoundException(__('Invalid font'));
		}
		$options = array('conditions' => array('Font.' . $this->Font->primaryKey => $id));
		$this->set('font', $this->Font->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Font->create();
			if ($this->Font->save($this->request->data)) {
				$this->Session->setFlash(__('The font has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The font could not be saved. Please, try again.'));
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
		if (!$this->Font->exists($id)) {
			throw new NotFoundException(__('Invalid font'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Font->save($this->request->data)) {
				$this->Session->setFlash(__('The font has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The font could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Font.' . $this->Font->primaryKey => $id));
			$this->request->data = $this->Font->find('first', $options);
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
		$this->Font->id = $id;
		if (!$this->Font->exists()) {
			throw new NotFoundException(__('Invalid font'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Font->delete()) {
			$this->Session->setFlash(__('Font deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Font was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
