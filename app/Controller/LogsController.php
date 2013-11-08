<?php

class LogsController extends AppController{

//	public $helpers = array('Markdown');

	public function index(){
		$user_id = $this->Auth->user('id');
		$start_date = $end_date = date("Y-m-d");
		$logs = $this->Log->getLogs($user_id, $start_date, $end_date);
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