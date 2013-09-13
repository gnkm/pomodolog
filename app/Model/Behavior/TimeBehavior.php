<?php

App::uses('ModelBehavior', 'Model');

class TimeBehavior extends ModelBehavior {

	/**
	 * 開始日時と期間を与えると、終了日時を返す
	 * 
	 * @param string $start_time
	 * @param string $period
	 * @return string
	 */
	public function getEnd(Model $Model, $start_time = null, $period = null) {
		return $this->setG();
		/* switch($period) { */
		/* 	case 'daily': */

		/* 	case 'weekly': */
		/* 	case 'monthly': */
		/* 	case 'anualy': */
		/* 	default: */
		/* }		 */
		/* return $date; */
	}

	/**
	 * 集計の開始時刻を得る
	 */
	private function setG() {
		// Todo:一日の区切りの時間をユーザ設定で変更できるようにすること
		// $now = date('Y-m-d G:i:s'); // 現在時刻のフルフォーマット
		$nowHour = date('G');
		$end_time = Configure::read('DayEnd');
		if ($nowHour >= $end_time) {
			$start = date('Y-m-d 0'.$end_time.':00:00', time() + 24 * 60* 60);
			return $start;
		}
	}

}