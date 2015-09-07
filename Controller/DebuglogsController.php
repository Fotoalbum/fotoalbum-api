<?php
App::uses('AppController', 'Controller');
/**
 * Debuglogs Controller
 *
 * @property Debuglog $Debuglog
 * @property PaginatorComponent $Paginator
 */
class DebuglogsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	
	var $_isConnected = false;

	var $cors_enabled = array();

 	var $components = array('RequestHandler', 'Auth', 'Session', 'Paginator');
	
/**
 * beforeFilter method
 *
 * @return void
 */
    public function beforeFilter() {
		
		parent::beforeFilter();

		$this->Auth->Allow();
		
		$this->cors_enabled = array(
			'http://api.xhibit.com',
			'http://www.xhibit.com',
			'http://beta.xhibit.com',
			'http://new.xhibit.com',
			'http://www.fotoalbum.nl',
			'http://mijn.fotoboek-maken.nl',
			'http://www.moments-to-share.nl',
			'http://enjoy.fotoalbum.nl',
			'http://www.fotoalbum.nl',
			'http://wwww.fotoalbum.be',			
		);												


		if( !defined("USE_ARRAY_COLLECTION_MAPPING") || USE_ARRAY_COLLECTION_MAPPING != true )
		{
				$this->response->header('Access-Control-Allow-Credentials', 'false');
				if (isset($_SERVER['HTTP_ORIGIN']))
				{
						if (in_array($_SERVER['HTTP_ORIGIN'],$this->cors_enabled))
						{
								$this->response->header('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN']);					
						}
				}
				else
				{
						foreach($this->cors_enabled as $cors_enabled)
						{
								$this->response->header('Access-Control-Allow-Origin', $cors_enabled);
						}
				}
				
				
				$this->response->header('Access-Control-Allow-Origin', '*');
				
				if ($this->request->is('OPTIONS') ) {
						$this->response->header('Access-Control-Allow-Methods', 'HEAD, GET, PUT, POST, OPTIONS, DELETE');
						$this->response->header('Access-Control-Max-Age', '604800');                        
						$this->response->header('Access-Control-Allow-Headers', 'Origin, Accept, Authorization, Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control');                        
						$this->response->send();
						exit(0);
				}
		}

		$this->autoRender = false;
		
		$user_database_source = $this->Session->read('connector.USERDB');
		if ( (isset($user_database_source)) && (!empty($user_database_source)) )
		{
			$this->LoadModel('User');
			$this->User->useDbConfig = $user_database_source;
		}
		
    }	

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Debuglog->recursive = 0;
		$this->set('debuglogs', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Debuglog->exists($id)) {
			throw new NotFoundException(__('Invalid debuglog'));
		}
		$options = array('conditions' => array('Debuglog.' . $this->Debuglog->primaryKey => $id));
		$this->set('debuglog', $this->Debuglog->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Debuglog->create();
			if ($this->Debuglog->save($this->request->data)) {
				$this->Session->setFlash(__('The debuglog has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The debuglog could not be saved. Please, try again.'));
			}
		}
		$users = $this->Debuglog->User->find('list');
		$products = $this->Debuglog->Product->find('list');
		$userProducts = $this->Debuglog->UserProduct->find('list');
		$this->set(compact('users', 'products', 'userProducts'));
	}
	

/**
 * insert method
 *
 * @return void
 */
	public function insert() {
		
		if ( ($this->request->is('ajax')) || ( (isset($this->request->params['ext'])) && ($this->request->params['ext'] == 'json') ) )
		{		
			if ($this->request->is('post')) {
				$this->Debuglog->create();
				$data = $this->Debuglog->save($this->request->data);
				$this->response->type('json');
				$this->response->body(json_encode($data));
				
			}
		}
		else
		{
			if ($this->request->is('post')) {
				debug($this->request->data);
			}
		}
		
		$this->set(compact('users', 'products', 'userProducts'));
	}	

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Debuglog->exists($id)) {
			throw new NotFoundException(__('Invalid debuglog'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Debuglog->save($this->request->data)) {
				$this->Session->setFlash(__('The debuglog has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The debuglog could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Debuglog.' . $this->Debuglog->primaryKey => $id));
			$this->request->data = $this->Debuglog->find('first', $options);
		}
		$users = $this->Debuglog->User->find('list');
		$products = $this->Debuglog->Product->find('list');
		$userProducts = $this->Debuglog->UserProduct->find('list');
		$this->set(compact('users', 'products', 'userProducts'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Debuglog->id = $id;
		if (!$this->Debuglog->exists()) {
			throw new NotFoundException(__('Invalid debuglog'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Debuglog->delete()) {
			$this->Session->setFlash(__('Debuglog deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Debuglog was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
