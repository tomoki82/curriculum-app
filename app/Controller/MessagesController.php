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
		$this->Message->recursive = -1;
		$this->Paginator->settings = array(
			'order' => array('Message.created' => 'desc'),
			'group' => 'Message.conversation_id',
			'limit' => 10,
			'contain' => ['User'],
		);
		$this->set('messages', $this->Paginator->paginate('Message'));
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->Message->create();
			$this->request->data['Message']['user_id'] = $this->Auth->user('id');
			if ($this->Message->save($this->request->data)) {
				$messageId = $this->Message->id;
				$message = $this->Message->findById($messageId);
				$response = [
					'status' => 'success',
					'Message' => [
						'id' => $messageId,
						'content' => $message['Message']['content'],
						'conversation_id' => $message['Message']['conversation_id'],
						'profile_img' => $message['User']['profile_img'],
					]
				];
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
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->request->allowMethod(['post', 'delete', 'ajax']);
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}
		$deleteConversation = $this->request->data('delete_conversation') == 'true' || $this->request->data('delete_conversation') == true;
		if (isset($deleteConversation) && $deleteConversation) {
			$message = $this->Message->findById($id);
			$conversationId = $message['Message']['conversation_id'];
			if ($this->Message->delete() && $this->Message->Conversation->delete($conversationId)) {
				$this->Flash->success(__('The message and the conversation have been deleted.'));
			} else {
				$this->Flash->error(__('The message could not be deleted. Please, try again.'));
			}
			return $this->redirect(['action' => 'index']);
		} else {
			if ($this->Message->delete()) {
				$response = ['status' => 'success', 'message' => 'The message has been deleted.'];
			}
			$this->autoRender = false;
			return json_encode($response);
		}
	}
}

