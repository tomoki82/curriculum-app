<?php
App::uses('AppModel', 'Model');
/**
 * Message Model
 *
 * @property User $User
 * @property Conversation $Conversation
 */
class Message extends AppModel {

	public function isOwnedBy($messageId, $userId) {
		$count = $this->find('count', array(
			'conditions' => array(
				'Message.id' => $messageId,
				'Message.user_id' => $userId
			),
		));
		return $count > 0;
}

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'content';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'content' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Conversation' => array(
			'className' => 'Conversation',
			'foreignKey' => 'conversation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
