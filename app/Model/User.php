<?php
App::uses('AppModel', 'Model');

class User extends AppModel {
	public $name = 'User';
	
	public function isUniqueAndActive($check){
		foreach ($check as $key => $value){
			$count = $this->find('count', array(
				'conditions' => array(
					$key => $value, 
					'is_active' => true, 
				), 
				'recursive' => -1
			));
			if ($count != 0){ return false; }
		}
		return true;
	}
	
	public function confirm($check){
		foreach ($check as $key => $value){
			if (! isset($this->data[$this->name][$key.'_confirm'])){
				return false;
			}
			if ($value !== $this->data[$this->name][$key.'_confirm']){
				return false;
			}
		}
		return true;
	}
}
