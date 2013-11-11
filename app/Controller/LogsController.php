<?php

class LogsController extends AppController{

	public function index(){
		$user_id = $this->Auth->user('id');
		$start_date = $end_date = date("Y-m-d");
		$logs = $this->Log->getLogs($user_id, $start_date, $end_date);
		$this->set(compact('user_id', 'start_date', 'logs'));
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

	public function delete($id){
		if ($this->request->is('post')) {
			$this->Log->id = $id;
			if ($this->Log->saveField('del_flg', true)) {
				$this->Session->setFlash('削除しました');
			} else {
				$this->Session->setFlash('削除に失敗しちゃった');
			}
		}		
		$this->redirect(array('controller' => 'logs', 'action' => 'index'));
	}

	public function calendar($date = null) {

	}

}
?>