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
		// thankyou.ctp display
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
    if ($this->request->is(['post', 'put'])) {
        if (!empty($this->request->data['User']['new_password'])) {
            $this->request->data['User']['password'] = $this->request->data['User']['new_password'];
        } else {
            unset($this->request->data['User']['password']);
        }
        if (!empty($this->request->data['User']['profile_img']['tmp_name']) && is_uploaded_file($this->request->data['User']['profile_img']['tmp_name'])) {
            $fileName = time() . '_' . $this->request->data['User']['profile_img']['name'];
            $filePath = WWW_ROOT . 'img' . DS . 'profile_imgs' . DS . $fileName;
            if (move_uploaded_file($this->request->data['User']['profile_img']['tmp_name'], $filePath)) {
                $this->request->data['User']['profile_img'] = 'profile_imgs/' . $fileName;
            } else {
                unset($this->request->data['User']['profile_img']);
            }
        } else {
            unset($this->request->data['User']['profile_img']);
        }

        if ($this->User->save($this->request->data)) {
            $this->Flash->success(__('The user has been saved.'));
            return $this->redirect(['action' => 'view', $id]);
        } else {
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
    } else {
        $options = ['conditions' => ['User.' . $this->User->primaryKey => $id]];
        $this->request->data = $this->User->find('first', $options);
        unset($this->request->data['User']['password']);
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
				'fields' => array('id', 'name', 'profile_img')
			));
			$results = array();
			// usersの情報をログに出力
			CakeLog::write('debug', print_r($users, true));
			foreach ($users as $user) {
				$results[] = array('id' => $user['User']['id'], 'text' => $user['User']['name'], 'profile_img' => $user['User']['profile_img']);
			}
			echo json_encode($results);
		}
	}

 /**
 * User Icon Display
 *
 * @param int $userId
 * @return
 */
	public function showUsersIcon($userId) {
		$this->autoRender = false;
		$this->layout = false;
		$userData = $this->User->findById($userId);
		if (empty($userData['User']['profile_img'])) {
			header('Content-type: image/jpeg');
			readfile(WWW_ROOT . 'img/default.png');
		} else {
			$filePath = WWW_ROOT . $userData['User']['profile_img'];
			if (file_exists($filePath)) {
				header('Content-type: image/jpeg');
				readfile($filePath);
			} else {
				header('Content-type: image/jpeg');
				readfile(WWW_ROOT . 'img/default.png');
			}
		}
		exit;
	}
}
