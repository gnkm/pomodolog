<?php
App::uses('AppModel', 'Model');
/**
 * Tag Model
 *
 * @property Logstag $Logstag
 */
class Tag extends AppModel {

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
			'notempty' => array(
				'rule' => array('notempty'),
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'LogsTag' => array(
			'className' => 'LogsTag',
			'foreignKey' => 'tag_id',
			'dependent' => false,
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Log' => array(
			'className' => 'Log',
			'joinTable' => 'logs_tags',
			'foreignKey' => 'tag_id',
			'associationForeignKey' => 'log_id',
		)
	);

	/**
	 * 新規タグをINSERTする
	 *
	 * @param array $tags
	 * @return bool
	 */
	public function saveNewTags ($tags) {
		// 新規タグを抽出
		$new_tags = array();
		foreach ($tags as $tag) {
			$tag_info = $this->findByName(trim($tag));
			if (empty($tag_info)) {
				$new_tags[] = trim($tag);
			}
		}
		if (!empty($new_tags)) {
			return true;
		} else {
			// INSERT
			$flg = true;
			while ($flg) {
				foreach ($new_tags as $tag) {
					$this->create();
					$flg = $this->save(array('name' => $tag));
					if (!$flg) {
						break 2;
					}
				}
				break;
			}
			return $flg;
		}
	}

}
