<?php
App::uses('AppController', 'Controller');
/**
 * StickerTypes Controller
 *
 * @property StickerType $StickerType
 * @property PaginatorComponent $Paginator
 */
class StickerTypesController extends AppController {

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
		$this->StickerType->recursive = 0;
		$this->set('stickerTypes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->StickerType->exists($id)) {
			throw new NotFoundException(__('Invalid sticker type'));
		}
		$options = array('conditions' => array('StickerType.' . $this->StickerType->primaryKey => $id));
		$this->set('stickerType', $this->StickerType->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->StickerType->create();
			if ($this->StickerType->save($this->request->data)) {
				$this->Session->setFlash(__('The sticker type has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sticker type could not be saved. Please, try again.'));
			}
		}
		$stickers = $this->StickerType->Sticker->find('list');
		$types = $this->StickerType->Type->find('list');
		$this->set(compact('stickers', 'types'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->StickerType->exists($id)) {
			throw new NotFoundException(__('Invalid sticker type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->StickerType->save($this->request->data)) {
				$this->Session->setFlash(__('The sticker type has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sticker type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('StickerType.' . $this->StickerType->primaryKey => $id));
			$this->request->data = $this->StickerType->find('first', $options);
		}
		$stickers = $this->StickerType->Sticker->find('list');
		$types = $this->StickerType->Type->find('list');
		$this->set(compact('stickers', 'types'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->StickerType->id = $id;
		if (!$this->StickerType->exists()) {
			throw new NotFoundException(__('Invalid sticker type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->StickerType->delete()) {
			$this->Session->setFlash(__('Sticker type deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Sticker type was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
