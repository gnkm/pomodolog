<?php

class LogsController extends AppController{

//	public $helpers = array('Markdown');

	public function index(){
		//3:00になったら表示をリセット
		if (date("G") < 3) {
			$start = date("Y-m-d 03:00:00", time() - 60*60*24);
		} else {
			$start = date("Y-m-d 03:00:00");
		}
		$end = date("Y-m-d 00:00:00", time() + 60*60*24);
		$condition = array(
			'Log.created BETWEEN ? AND ?' => array(
				$start,
				$end
			)
		);
		$test_logs = $this->Log->getLogs();
		debug($test_logs);
		$user_id = $this->Auth->user('id');
		$logs = $this->Log->find(
			'all',
			array(
				'conditions' => array(
					'user_id' => $user_id,
					'Log.created BETWEEN ? AND ?' => array(
						$start,
						$end
					)
				)
			)
		);
		debug($logs);
		debug($logs[0]['Log']['created']);
		debug($this->Log->getEnd());
		$this->set(compact('user_id', 'logs'));
	}

	public function add(){
		if ($this->request->is('post')) {
			$this->Log->create();
			if($this->Log->saveLogsAndTags($this->request->data)) {
				$this->Session->setFlash('登録しました');
			} else {
				$this->Session->setFlash('登録に失敗しちゃった');
			}
		}
		$this->redirect(array('controller' => 'logs', 'action' => 'index'));
	}

	public function view($date, $terms){
	}

	public function delete($id){
	}

}
?>