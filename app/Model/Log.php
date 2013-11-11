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
	 * @param string $end_date
	 * @return array
	 */
	public function getLogs($user_id, $start_date, $end_date) {
		$start_time = strtotime($start_date);
		$start_date = date("Y-m-d 03:00:00", $start_time);
		$end_time = strtotime($end_date) + 60*60*24;
		$end_date = date("Y-m-d 02:59:00", $end_time);
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
		// parse title
		$ret = $this->parseTitle($data['Log']['title']);
		$data['Log']['title'] = $ret['title'];
		$iterate_num = $ret['iterate_num'];

		$this->tpBegin();
		$flg = true;
		while ($flg) {
			// logsテーブルにINSERT
			$logs_result = $this->iterateSave($data, $iterate_num);
			if (!$logs_result['flg']) {
				break;
			}

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
			$flg = $this->LogsTag->saveManyLogsAndTags($logs_result['ids'], $save_tags, $iterate_num);

			break;
		}
		return $this->tpFinish($flg);
	}

	/**
	 * 1つのデータを複数のレコードとして登録する
	 *
	 * @param array $data
	 * @param int $iterate_num
	 * @return array
	 */
	public function iterateSave($data, $iterate_num) {
		$flg = true;
		while ($flg) {
			foreach (range(1, $iterate_num) as $cnt) {
				$this->create();
				$flg = $this->save($data);
				if ($flg) {
					$ret['ids'][] = $this->getLastInsertId();
				} else {
					$ret['flg'] = false;
					break;
				}
			}
			$ret['flg'] = true;
			break;
		}
		return $ret;
	}

	/**
	 * Titleをパースし、繰り返し回数、タイトルを返す
	 *
	 * @param string $title
	 * @return array
	 */
	private function parseTitle($title) {
		$ret = array(
			'title' => '',
			'iterate_num'
		);
		$pattern = "/(.+)\[(\d+)pomo\]$/";
		preg_match($pattern, $title, $matches);
		if(!empty($matches)) {
			$ret['title'] = $matches[1];
			$ret['iterate_num'] = $matches[2];
		} else {
			$ret['title'] = $title;
			$ret['iterate_num'] = 1;
		}
		return $ret;
	}
}
