<?php
App::uses('AppController', 'Controller');
/**
 * MaskStyles Controller
 *
 * @property MaskStyle $MaskStyle
 * @property PaginatorComponent $Paginator
 */
class MaskStylesController extends AppController {

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
		$this->MaskStyle->recursive = 0;
		$this->set('maskStyles', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->MaskStyle->exists($id)) {
			throw new NotFoundException(__('Invalid mask style'));
		}
		$options = array('conditions' => array('MaskStyle.' . $this->MaskStyle->primaryKey => $id));
		$this->set('maskStyle', $this->MaskStyle->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->MaskStyle->create();
			if ($this->MaskStyle->save($this->request->data)) {
				$this->Session->setFlash(__('The mask style has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mask style could not be saved. Please, try again.'));
			}
		}
		$masks = $this->MaskStyle->Mask->find('list');
		$styles = $this->MaskStyle->Style->find('list');
		$this->set(compact('masks', 'styles'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->MaskStyle->exists($id)) {
			throw new NotFoundException(__('Invalid mask style'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MaskStyle->save($this->request->data)) {
				$this->Session->setFlash(__('The mask style has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mask style could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MaskStyle.' . $this->MaskStyle->primaryKey => $id));
			$this->request->data = $this->MaskStyle->find('first', $options);
		}
		$masks = $this->MaskStyle->Mask->find('list');
		$styles = $this->MaskStyle->Style->find('list');
		$this->set(compact('masks', 'styles'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->MaskStyle->id = $id;
		if (!$this->MaskStyle->exists()) {
			throw new NotFoundException(__('Invalid mask style'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MaskStyle->delete()) {
			$this->Session->setFlash(__('Mask style deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Mask style was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
