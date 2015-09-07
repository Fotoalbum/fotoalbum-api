<?php
App::uses('AppController', 'Controller');
/**
 * BackgroundTypes Controller
 *
 * @property BackgroundType $BackgroundType
 * @property PaginatorComponent $Paginator
 */
class BackgroundTypesController extends AppController {

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
		$this->BackgroundType->recursive = 0;
		$this->set('backgroundTypes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->BackgroundType->exists($id)) {
			throw new NotFoundException(__('Invalid background type'));
		}
		$options = array('conditions' => array('BackgroundType.' . $this->BackgroundType->primaryKey => $id));
		$this->set('backgroundType', $this->BackgroundType->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->BackgroundType->create();
			if ($this->BackgroundType->save($this->request->data)) {
				$this->Session->setFlash(__('The background type has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The background type could not be saved. Please, try again.'));
			}
		}
		$backgrounds = $this->BackgroundType->Background->find('list');
		$types = $this->BackgroundType->Type->find('list');
		$this->set(compact('backgrounds', 'types'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->BackgroundType->exists($id)) {
			throw new NotFoundException(__('Invalid background type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BackgroundType->save($this->request->data)) {
				$this->Session->setFlash(__('The background type has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The background type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BackgroundType.' . $this->BackgroundType->primaryKey => $id));
			$this->request->data = $this->BackgroundType->find('first', $options);
		}
		$backgrounds = $this->BackgroundType->Background->find('list');
		$types = $this->BackgroundType->Type->find('list');
		$this->set(compact('backgrounds', 'types'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->BackgroundType->id = $id;
		if (!$this->BackgroundType->exists()) {
			throw new NotFoundException(__('Invalid background type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->BackgroundType->delete()) {
			$this->Session->setFlash(__('Background type deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Background type was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
