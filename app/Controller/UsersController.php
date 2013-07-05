<?php

class UsersController extends AppController{

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('add');
	}

	public function login(){
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash('ログインに失敗しちゃった');
			}
		}
	}

	public function logout(){
		$this->redirect($this->Auth->logout());
	}

	public function add(){
		if ($this->request->is('post')) {
			$this->User->create();
			if($this->User->save($this->request->data)) {
				$this->redirect(array('controller' => 'logs', 'action' => 'index'));
			} else {
				$this->session->setFlash('登録に失敗しちゃった');
			}
		}
	}

	public function edit($id){
	}

	public function delete($id){
	}

}

