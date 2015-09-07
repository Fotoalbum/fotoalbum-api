<?php
App::uses('AppController', 'Controller');
/**
 * MaskTypes Controller
 *
 * @property MaskType $MaskType
 * @property PaginatorComponent $Paginator
 */
class MaskTypesController extends AppController {

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
		$this->MaskType->recursive = 0;
		$this->set('maskTypes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->MaskType->exists($id)) {
			throw new NotFoundException(__('Invalid mask type'));
		}
		$options = array('conditions' => array('MaskType.' . $this->MaskType->primaryKey => $id));
		$this->set('maskType', $this->MaskType->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->MaskType->create();
			if ($this->MaskType->save($this->request->data)) {
				$this->Session->setFlash(__('The mask type has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mask type could not be saved. Please, try again.'));
			}
		}
		$masks = $this->MaskType->Mask->find('list');
		$types = $this->MaskType->Type->find('list');
		$this->set(compact('masks', 'types'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->MaskType->exists($id)) {
			throw new NotFoundException(__('Invalid mask type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MaskType->save($this->request->data)) {
				$this->Session->setFlash(__('The mask type has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mask type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MaskType.' . $this->MaskType->primaryKey => $id));
			$this->request->data = $this->MaskType->find('first', $options);
		}
		$masks = $this->MaskType->Mask->find('list');
		$types = $this->MaskType->Type->find('list');
		$this->set(compact('masks', 'types'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->MaskType->id = $id;
		if (!$this->MaskType->exists()) {
			throw new NotFoundException(__('Invalid mask type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MaskType->delete()) {
			$this->Session->setFlash(__('Mask type deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Mask type was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
