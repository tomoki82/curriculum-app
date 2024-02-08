<?php
App::uses('AppController', 'Controller');
/**
 * Conversations Controller
 *
 * @property Conversation $Conversation
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class ConversationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->loadModel('Message');
		$this->Message->recursive = -1;
		$this->set('currentUser', $this->Auth->user());

		if (!$this->Conversation->exists($id)) {
			throw new NotFoundException(__('Invalid conversation'));
		}

		$this->Paginator->settings = array(
			'conditions' => array('Message.conversation_id' => $id),
			'contain' => ['User'],
			'limit' => 10,
			'order' => array('Message.created' => 'desc'),
		);
		$messages = $this->Paginator->paginate('Message');
    	$this->set('messages', $messages);
		$conversation = $this->Conversation->find('first', [
			'conditions' => ['Conversation.' . $this->Conversation->primaryKey => $id],
		]);
		$this->set('conversation', $conversation);
	}

}
