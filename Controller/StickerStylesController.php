<?php
App::uses('AppController', 'Controller');
/**
 * StickerStyles Controller
 *
 * @property StickerStyle $StickerStyle
 * @property PaginatorComponent $Paginator
 */
class StickerStylesController extends AppController {

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
		$this->StickerStyle->recursive = 0;
		$this->set('stickerStyles', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->StickerStyle->exists($id)) {
			throw new NotFoundException(__('Invalid sticker style'));
		}
		$options = array('conditions' => array('StickerStyle.' . $this->StickerStyle->primaryKey => $id));
		$this->set('stickerStyle', $this->StickerStyle->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->StickerStyle->create();
			if ($this->StickerStyle->save($this->request->data)) {
				$this->Session->setFlash(__('The sticker style has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sticker style could not be saved. Please, try again.'));
			}
		}
		$stickers = $this->StickerStyle->Sticker->find('list');
		$styles = $this->StickerStyle->Style->find('list');
		$this->set(compact('stickers', 'styles'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->StickerStyle->exists($id)) {
			throw new NotFoundException(__('Invalid sticker style'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->StickerStyle->save($this->request->data)) {
				$this->Session->setFlash(__('The sticker style has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sticker style could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('StickerStyle.' . $this->StickerStyle->primaryKey => $id));
			$this->request->data = $this->StickerStyle->find('first', $options);
		}
		$stickers = $this->StickerStyle->Sticker->find('list');
		$styles = $this->StickerStyle->Style->find('list');
		$this->set(compact('stickers', 'styles'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->StickerStyle->id = $id;
		if (!$this->StickerStyle->exists()) {
			throw new NotFoundException(__('Invalid sticker style'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->StickerStyle->delete()) {
			$this->Session->setFlash(__('Sticker style deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Sticker style was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
