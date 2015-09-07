<?php
App::uses('AppController', 'Controller');
/**
 * BackgroundStyles Controller
 *
 * @property BackgroundStyle $BackgroundStyle
 * @property PaginatorComponent $Paginator
 */
class BackgroundStylesController extends AppController {

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
		$this->BackgroundStyle->recursive = 0;
		$this->set('backgroundStyles', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->BackgroundStyle->exists($id)) {
			throw new NotFoundException(__('Invalid background style'));
		}
		$options = array('conditions' => array('BackgroundStyle.' . $this->BackgroundStyle->primaryKey => $id));
		$this->set('backgroundStyle', $this->BackgroundStyle->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->BackgroundStyle->create();
			if ($this->BackgroundStyle->save($this->request->data)) {
				$this->Session->setFlash(__('The background style has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The background style could not be saved. Please, try again.'));
			}
		}
		$backgrounds = $this->BackgroundStyle->Background->find('list');
		$styles = $this->BackgroundStyle->Style->find('list');
		$this->set(compact('backgrounds', 'styles'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->BackgroundStyle->exists($id)) {
			throw new NotFoundException(__('Invalid background style'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BackgroundStyle->save($this->request->data)) {
				$this->Session->setFlash(__('The background style has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The background style could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BackgroundStyle.' . $this->BackgroundStyle->primaryKey => $id));
			$this->request->data = $this->BackgroundStyle->find('first', $options);
		}
		$backgrounds = $this->BackgroundStyle->Background->find('list');
		$styles = $this->BackgroundStyle->Style->find('list');
		$this->set(compact('backgrounds', 'styles'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->BackgroundStyle->id = $id;
		if (!$this->BackgroundStyle->exists()) {
			throw new NotFoundException(__('Invalid background style'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->BackgroundStyle->delete()) {
			$this->Session->setFlash(__('Background style deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Background style was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
