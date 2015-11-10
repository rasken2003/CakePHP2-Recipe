<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class SignupController extends AppController {
	public $name = 'Signup';
	public $uses = array('User');
	public $components = array('Auth');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow();
	}
	
	public function index(){
		if (! $this->request->data){
			$this->render();
			return;
		}
		
		$this->User->validate = array(
			'email' => array(
				array(
					'rule' => 'notEmpty', 
					'message' => 'メールアドレスを入力してください'
				), 
				array(
					'rule' => array('custom', '/^.+@.+$/'), 
					'message' => 'メールアドレスの形式が正しくありません。', 
				), 
				array(
					'rule' => 'confirm', 
					'message' => 'メールアドレスが一致していません。', 
				), 
				array(
					'rule' => 'isUniqueAndActive', 
					'message' => 'このメールアドレスは使用されています。', 
				)
			)
		);
		$this->User->set($this->request->data);
		if (! $this->User->invalidFields()){
			$email = $this->request->data['User']['email'];
			$activation_code = md5($email.time());
			
			$user = $this->User->find('first', array('conditions' => array('email' => $email, 'is_active' => false)));
			if (! $user){
				$this->User->create();
				$user = array('User' => $this->request->data['User']);
			}
			$user['User']['is_active'] = false;
			$user['User']['activation_code'] = $activation_code;
			$this->User->save($user);
			
			$cakeemail = new CakeEmail('default');
			$cakeemail->to($email);
			$cakeemail->subject('仮登録のお知らせ');
			$cakeemail->send(sprintf('http://example.com/signup/activate/%s', $activation_code));
			
			$this->render('email_sent');
		}
	}
	
	public function activate($activation_code){
		$user = $this->User->find('first', array('conditions' => array('activation_code' => $activation_code, 'is_active' => false)));
		if (! $user){ $this->redirect('/signup/index'); }
		
		if (! $this->request->data){
			$this->render();
			return;
		}
		$this->User->validate = array(
			'password' => array(
				array(
					'rule' => 'notEmpty', 
					'message' => 'パスワードを入力してください。'
				), 
				array(
					'rule' => array('custom', '/^[a-zA-Z0-9]+$/'), 
					'message' => '半角英数字で入力してください。', 
				), 
				array(
					'rule' => 'confirm', 
					'message' => 'パスワードが一致していません。', 
				), 
			), 
		);
		$this->User->set($this->request->data);
		if (! $this->User->invalidFields()){
			$user['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
			unset($user['User']['password_confirm']);
			$user['User']['is_active'] = true;
			
			$this->User->validate = array();
			$this->User->save($user);
			
			$this->Auth->login($user);
			$this->redirect($this->Auth->redirectUrl());
		}
	}
	
}
