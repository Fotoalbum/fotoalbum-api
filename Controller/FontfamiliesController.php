<?php
App::uses('AppController', 'Controller');
/**
 * Fontfamilies Controller
 *
 * @property Fontfamily $Fontfamily
 * @property PaginatorComponent $Paginator
 */
class FontfamiliesController extends AppController {

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
		$this->Fontfamily->recursive = 0;
		$this->set('fontfamilies', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Fontfamily->exists($id)) {
			throw new NotFoundException(__('Invalid fontfamily'));
		}
		$options = array('conditions' => array('Fontfamily.' . $this->Fontfamily->primaryKey => $id));
		$this->set('fontfamily', $this->Fontfamily->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Fontfamily->create();
			if ($this->Fontfamily->save($this->request->data)) {
				$this->Session->setFlash(__('The fontfamily has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fontfamily could not be saved. Please, try again.'));
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
		if (!$this->Fontfamily->exists($id)) {
			throw new NotFoundException(__('Invalid fontfamily'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Fontfamily->save($this->request->data)) {
				$this->Session->setFlash(__('The fontfamily has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fontfamily could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Fontfamily.' . $this->Fontfamily->primaryKey => $id));
			$this->request->data = $this->Fontfamily->find('first', $options);
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
		$this->Fontfamily->id = $id;
		if (!$this->Fontfamily->exists()) {
			throw new NotFoundException(__('Invalid fontfamily'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Fontfamily->delete()) {
			$this->Session->setFlash(__('Fontfamily deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Fontfamily was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
