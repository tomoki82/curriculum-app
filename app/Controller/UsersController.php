<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session', 'Flash');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add', 'thankyou');
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('last_login_time', date('Y-m-d H:i:s'));
				$this->redirect('/');
			} else {
				$this->Session->setFlash(__('Invalid email or password, try again'));
			}
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				return $this->redirect(array('controller' => 'users', 'action' => 'thankyou'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
	}

	public function thankyou() {
		// thankyou.ctpを表示する
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if (!empty($this->request->data['User']['new_password'])) {
				$this->request->data['User']['password'] = $this->request->data['User']['new_password'];
			} else {
				unset($this->request->data['User']['password']);
			}
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete($id)) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function search() {
		$this->autoRender = false;
		if ($this->request->is('get')) {
			$query = $this->request->query('term');
			$users = $this->User->find('all', array(
				'conditions' => array('User.name LIKE' => '%' . $query . '%'),
				'fields' => array('id', 'name')
			));
			$results = array();
			foreach ($users as $user) {
				$results[] = array('id' => $user['User']['id'], 'text' => $user['User']['name']);
			}
			echo json_encode($results);
		}
	}
}
