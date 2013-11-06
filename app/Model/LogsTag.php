<?php
App::uses('AppModel', 'Model');
/**
 * LogsTag Model
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

	/**
	 * logs_tagsテーブルにINSERT
	 *
	 * @param int $log_id
	 * @param array $tags
	 * @return bool
	 */
	public function saveMany($log_id, $tags) {
		// フォーマット
		$tag_ids = Hash::combine($tags, '{n}.Tag.id', '{n}.Tag.id');
		$flg = true;
		while ($flg) {
			foreach ($tag_ids as $tag_id) {
				$this->create();
				$flg = $this->save(
					array(
						'log_id' => $log_id,
						'tag_id' => $tag_id
					)
				);
				if (!$flg) {
					break 2;
				}
			}
			break;
		}
		return $flg;
	}
}
