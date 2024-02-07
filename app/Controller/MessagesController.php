<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class MessagesController extends AppController {
	public $uses = array('Message', 'Conversation');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

	public function isAuthorized($user) {
		if ($this->action === 'add' || $this->action === 'index') {
			return true;
		}

		if (in_array($this->action, array('edit', 'delete'))) {
			$messageId = (int) $this->request->params['pass'][0];
			if ($this->Message->isOwnedBy($messageId, $user['id'])) {
				return true;
			}
		}

		return parent::isAuthorized($user);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Message->recursive = 0;
		$this->Paginator->settings = array(
			'order' => array('Message.created' => 'desc'),
			'group' => 'Message.conversation_id',
			'limit' => 10,
		);
		$this->set('messages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
		$this->set('message', $this->Message->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		// ajaxでのリクエストの場合の処理
		if ($this->request->is('ajax')) {
			// TODO: ユーザー諸々のデータを含めたレスポンスを返す
			$this->log($this->request->data, 'debug');
			$this->autoRender = false;
			$this->Message->create();
			$this->request->data['Message']['user_id'] = $this->Auth->user('id');
			if ($this->Message->save($this->request->data)) {
				$response = ['status' => 'success', 'message' => 'The message has been saved.'];
			} else {
				$response = ['status' => 'error', 'message' => 'The message could not be saved. Please, try again.'];
			}
			$this->response->type('application/json');
			$this->response->body(json_encode($response));
			return $this->response;
		}
		if ($this->request->is('post')) {
			$currentUserId = $this->Auth->user('id');
    		$this->request->data['Message']['user_id'] = $currentUserId;
			if (!empty($this->request->data['Message']['conversation_id'])) {
				$conversationId = $this->request->data['Message']['conversation_id'];
			} else {
				$conversationData = array(
					'Conversation' => array(
						'user_id' => $currentUserId,
					)
				);
				$this->Conversation->create();
				if ($this->Conversation->save($conversationData)) {
					$conversationId = $this->Conversation->id;
				}
			}
			$this->request->data['Message']['conversation_id'] = $conversationId;

			$this->Message->create();
			if ($this->Message->save($this->request->data)) {
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The message could not be saved. Please, try again.'));
			}
		}

		$users = $this->Message->User->find('list');
		$conversations = $this->Message->Conversation->find('list');
		$this->set(compact('users', 'conversations'));
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Message->save($this->request->data)) {
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
		}
		$users = $this->Message->User->find('list');
		$conversations = $this->Message->Conversation->find('list');
		$this->set(compact('users', 'conversations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		debug($this->request->data);
		$this->request->allowMethod(['post', 'delete']);
		$message = $this->Message->findById($id);
		debug($message);
		if ($message) {
			if ($this->Message->delete($id) && $this->Message->Conversation->deleteAll(['conversation.id' => $message['Message']['conversation_id']])) {
				$this->set('response', ['status' => 'success']);
				return $this->redirect(['action' => 'index']);
				$this->autoRender = false;
			} else {
				$this->set('response', ['status' => 'error']);
				$this->autoRender = false;
            	return $this->redirect(['action' => 'index']);
			}
		}
		$this->set('_serialize', ['response']);
	}
}

