<?php
App::uses('AppController', 'Controller');
/**
 * Masks Controller
 *
 * @property Mask $Mask
 * @property PaginatorComponent $Paginator
 */
class MasksController extends AppController {

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
		$this->Mask->recursive = 0;
		$this->set('masks', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Mask->exists($id)) {
			throw new NotFoundException(__('Invalid mask'));
		}
		$options = array('conditions' => array('Mask.' . $this->Mask->primaryKey => $id));
		$this->set('mask', $this->Mask->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Mask->create();
			if ($this->Mask->save($this->request->data)) {
				$this->Session->setFlash(__('The mask has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mask could not be saved. Please, try again.'));
			}
		}
		$styles = $this->Mask->Style->find('list');
		$types = $this->Mask->Type->find('list', array('conditions'=>array('foreign_model'=>'Mask')));
		$categories = $this->Mask->Category->find('list');
		$tags = $this->Mask->Tag->find('list');
		$this->set(compact('styles', 'types', 'categories', 'tags'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Mask->exists($id)) {
			throw new NotFoundException(__('Invalid mask'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Mask->save($this->request->data)) {
				$this->Session->setFlash(__('The mask has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mask could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Mask.' . $this->Mask->primaryKey => $id));
			$this->request->data = $this->Mask->find('first', $options);
		}
		$styles = $this->Mask->Style->find('list');
		$types = $this->Mask->Type->find('list', array('conditions'=>array('foreign_model'=>'Mask')));
		$categories = $this->Mask->Category->find('list');
		$tags = $this->Mask->Tag->find('list');
		$this->set(compact('styles', 'types', 'categories', 'tags'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Mask->id = $id;
		if (!$this->Mask->exists()) {
			throw new NotFoundException(__('Invalid mask'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Mask->delete()) {
			$this->Session->setFlash(__('Mask deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Mask was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
