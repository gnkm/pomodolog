<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

	/**
	 * トランザクション開始
	 *
	 * @return void
	 */
	public function tpBegin() {
		if (!$this->dataSource) {
			$this->dataSource = $this->getDataSource();
		}
		$this->dataSource->begin();
	}

	/**
	 * トランザクション終了
	 *
	 * @param bool $flg
	 * @return bool
	 */
	public function tpFinish($flg) {
		if ($flg) {
			return $this->dataSource->commit();
		} else {
			$this->dataSource->rollback();
			return false;
		}
	}

}
