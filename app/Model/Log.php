<?php
App::uses('AppModel', 'Model');
/**
 * Log Model
 *
 * @property User $User
 * @property Logstag $Logstag
 */
class Log extends AppModel {

	public $actsAs = array('Time');

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'del_flg' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Tag' => array(
			'className' => 'Tag',
			'joinTable' => 'logs_tags',
			'foreignKey' => 'log_id',
			'associationForeignKey' => 'tag_id',
		)
	);

	/**
	 * 指定期間のログを得る
	 * @param string $start_day
	 * @param int $type (0:day, 1:week, 2:month, 3:year)
	 * @return array
	 */
	public function getLogs($start_day = null, $type = null){
		return $this->getEnd();
		/* return 0; */
	}

	/**
	 * logsテーブルとtagsテーブルにINSERT
	 *
	 * @param array $data
	 * @return bool
	 */
	public function saveLogsAndTags ($data) {
		$this->tpBegin();
		$flg = true;
		while ($flg) {
			// logsテーブルにINSERT
			$flg = $this->save($data);
			if (!$flg) {
				break;
			}
			$log_id = $this->getLastInsertID();

			// tagsテーブルにINSERT
			$tags = explode(",", trim($data['Log']['tag']));
			$flg = $this->Tag->saveNewTags($tags);
			if (!$flg) {
				break;
			}
			// logs_tagsテーブルにINSERT
			$save_tags = array();
			foreach ($tags as $tag) {
				$save_tags[] = $this->Tag->findByName($tag);
			}
			$flg = $this->LogsTag->saveMany(array($log_id), $save_tags);

			break;
		}
		return $this->tpFinish($flg);
	}

}
