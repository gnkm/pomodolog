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
		$this->Log->recursive = 0;
		$this->set('logs', $this->paginate($condition));
	}

	public function add(){
		if ($this->request->is('post')) {
			$this->Log->create();
			if($this->Log->save($this->request->data)) {
				$this->redirect(array('controller' => 'logs', 'action' => 'index'));
			} else {
				$this->session->setFlash('登録に失敗しちゃった');
			}
		}
		$user_id = $this->Auth->user('id');
		$this->set(compact('user_id'));
	}

	public function view($date, $terms){
	}

	public function delete($id){
	}

}
?>