<?php

class LogsController extends AppController{

	public function index(){

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