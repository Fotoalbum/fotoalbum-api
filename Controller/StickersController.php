<?php
App::uses('AppController', 'Controller');
/**
 * Stickers Controller
 *
 * @property Sticker $Sticker
 * @property PaginatorComponent $Paginator
 */
class StickersController extends AppController {

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
		$this->Sticker->recursive = 0;
		$this->set('stickers', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Sticker->exists($id)) {
			throw new NotFoundException(__('Invalid sticker'));
		}
		$options = array('conditions' => array('Sticker.' . $this->Sticker->primaryKey => $id));
		$this->set('sticker', $this->Sticker->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Sticker->create();
			if ($this->Sticker->save($this->request->data)) {
				$this->Session->setFlash(__('The sticker has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sticker could not be saved. Please, try again.'));
			}
		}
		$styles = $this->Sticker->Style->find('list');
		$types = $this->Sticker->Type->find('list', array('conditions'=>array('foreign_model'=>'Sticker')));
		$categories = $this->Sticker->Category->find('list');
		$tags = $this->Sticker->Tag->find('list');
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
		if (!$this->Sticker->exists($id)) {
			throw new NotFoundException(__('Invalid sticker'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Sticker->save($this->request->data)) {
				$this->Session->setFlash(__('The sticker has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sticker could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Sticker.' . $this->Sticker->primaryKey => $id));
			$this->request->data = $this->Sticker->find('first', $options);
		}
		$styles = $this->Sticker->Style->find('list');
		$types = $this->Sticker->Type->find('list', array('conditions'=>array('foreign_model'=>'Sticker')));
		$categories = $this->Sticker->Category->find('list');
		$tags = $this->Sticker->Tag->find('list');
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
		$this->Sticker->id = $id;
		if (!$this->Sticker->exists()) {
			throw new NotFoundException(__('Invalid sticker'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Sticker->delete()) {
			$this->Session->setFlash(__('Sticker deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Sticker was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
