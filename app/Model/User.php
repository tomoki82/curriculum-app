<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 * @property Conversation $Conversation
 * @property Message $Message
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Name is required',
			),
			'length' => array(
				'rule' => array('lengthBetween', 5, 20),
				'message' => 'Name must be between 5 and 20 characters long'
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please provide a valid email address.',
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This email is already used.',
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'on' => 'create',
			),
		),
		'birthdate' => array(
			'date' => array(
				'rule' => array('date'),
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Conversation' => array(
			'className' => 'Conversation',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }

	public function beforeValidate($options = array()) {
		parent::beforeValidate($options);
		if (!empty($this->id) || !empty($this->data[$this->alias]['id'])) {
			$this->validate['birthdate'] = array_merge($this->validate['birthdate'], [
				'notBlank' => [
					'rule' => 'notBlank',
					'message' => 'Birthdate is required on update.'
				]
			]);
			$this->validate['gender'] = array_merge($this->validate['gender'], [
				'notBlank' => [
					'rule' => 'notBlank',
					'message' => 'Gender is required on update.'
				]
			]);
			$this->validate['hobby'] = array_merge($this->validate['hobby'], [
				'notBlank' => [
					'rule' => 'notBlank',
					'message' => 'Hobby is required on update.'
				]
			]);
		}
		return true;
	}
	
}
