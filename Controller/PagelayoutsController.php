<?php
App::uses('AppController', 'Controller');
/**
 * Pagelayouts Controller
 *
 * @property Pagelayout $Pagelayout
 * @property PaginatorComponent $Paginator
 */
class PagelayoutsController extends AppController {

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
		$this->Pagelayout->recursive = 0;
		$this->set('pagelayouts', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Pagelayout->exists($id)) {
			throw new NotFoundException(__('Invalid pagelayout'));
		}
		$options = array('conditions' => array('Pagelayout.' . $this->Pagelayout->primaryKey => $id));
		$this->set('pagelayout', $this->Pagelayout->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Pagelayout->create();
			if ($this->Pagelayout->save($this->request->data)) {
				$this->Session->setFlash(__('The pagelayout has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pagelayout could not be saved. Please, try again.'));
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
		if (!$this->Pagelayout->exists($id)) {
			throw new NotFoundException(__('Invalid pagelayout'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Pagelayout->save($this->request->data)) {
				$this->Session->setFlash(__('The pagelayout has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pagelayout could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Pagelayout.' . $this->Pagelayout->primaryKey => $id));
			$this->request->data = $this->Pagelayout->find('first', $options);
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
		$this->Pagelayout->id = $id;
		if (!$this->Pagelayout->exists()) {
			throw new NotFoundException(__('Invalid pagelayout'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Pagelayout->delete()) {
			$this->Session->setFlash(__('Pagelayout deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Pagelayout was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
