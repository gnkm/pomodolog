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
		$user_id = $this->Auth->user('id');
		$logs = $this->Log->getLogs($user_id, null, 'd');
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