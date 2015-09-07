<?php
App::uses('AppController', 'Controller');
/**
 * Debuggers Controller
 *
 * @property Debugger $Debugger
 * @property PaginatorComponent $Paginator
 */
class DebuggersController extends AppController {

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
		
		$this->Auth->Allow('insert');
		
		$this->set(compact('og_data'));		
    }	

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Debugger->recursive = 0;
		$this->set('debuggers', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Debugger->exists($id)) {
			throw new NotFoundException(__('Invalid debugger'));
		}
		$options = array('conditions' => array('Debugger.' . $this->Debugger->primaryKey => $id));
		$this->set('debugger', $this->Debugger->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Debugger->create();
			if ($this->Debugger->save($this->request->data)) {
				$this->Session->setFlash(__('The debugger has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The debugger could not be saved. Please, try again.'));
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
		if (!$this->Debugger->exists($id)) {
			throw new NotFoundException(__('Invalid debugger'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Debugger->save($this->request->data)) {
				$this->Session->setFlash(__('The debugger has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The debugger could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Debugger.' . $this->Debugger->primaryKey => $id));
			$this->request->data = $this->Debugger->find('first', $options);
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
		$this->Debugger->id = $id;
		if (!$this->Debugger->exists()) {
			throw new NotFoundException(__('Invalid debugger'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Debugger->delete()) {
			$this->Session->setFlash(__('Debugger deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Debugger was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
