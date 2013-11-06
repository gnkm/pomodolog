<?php
App::uses('AppModel', 'Model');
/**
 * Log Model
 *
 * @property User $User
 * @property Logstag $Logstag
 */
class Log extends AppModel {

	public $actsAs = array('Containable', 'Time');

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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'LogsTag' => array(
			'className' => 'LogsTag',
			'foreignKey' => 'log_id',
			'dependent' => false,
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
	 *
	 * @param int $user_id
	 * @param string $start_date
	 * @param int $type (0:day, 1:week, 2:month, 3:year)
	 * @return array
	 */
	public function getLogs($user_id, $start_date = null, $type = null){
		if (is_null($start_date)) {
			//3:00になったら表示をリセット
			if (date("G") < 3) {
				$start_time = time() - 60*60*24;
				$start_date = date("Y-m-d 03:00:00", $start_time);
			} else {
				$start_time = time();
				$start_date = date("Y-m-d 03:00:00", $start_time);
			}
		}
		switch ($type) {
			case 'd':
				$end_date = date("Y-m-d 02:59:59", $start_time + 60*60*24);
				break;
				// Todo:あとで実装する
			/* case 'w': */
			/* 	break; */
			/* case 'm': */
			/* 	break; */
			/* case 'y': */
			/* 	break; */
		}
		return $this->find(
			'all',
			array(
				'conditions' => array(
					'Log.user_id' => $user_id,
					'Log.created BETWEEN ? AND ?' => array($start_date, $end_date),
					'Log.del_flg' => false
				),
				'contain' => array(
					'Tag' => array(
						'conditions' => array(
							'Tag.del_flg' => false
						)
					)
				)
			)
		);
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
				$save_tags[] = $this->Tag->findByName(trim($tag));
			}
			$flg = $this->LogsTag->saveMany($log_id, $save_tags);

			break;
		}
		return $this->tpFinish($flg);
	}

}
