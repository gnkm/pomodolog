<?php
App::uses('AppModel', 'Model');
/**
 * Logstag Model
 *
 * @property Log $Log
 * @property Tag $Tag
 */
class LogsTag extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'logs_tags';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Log' => array(
			'className' => 'Log',
			'foreignKey' => 'log_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tag' => array(
			'className' => 'Tag',
			'foreignKey' => 'tag_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
