<?php
App::uses('AppController', 'Controller');

class ItemsController extends AppController {
	public $name = 'Items';
	public $uses = array('Item');
	
	public function detail($id){
		$item = $this->Item->find('first', array('conditions' => array('Item.id' => $id)));
		if (! $item){ throw new NotFoundException(); }
		
		$this->set('item', $item);
	}
	
	public function edit($id = null){
		if ($this->request->data){
			$this->request->data['Item']['id'] = $id;
			
			$this->Item->set($this->request->data);
			if (! $this->Item->validates()){
				$this->render('edit');
			} else {
				switch($this->request->data['System']['action']){
					case 'confirm':
						$this->render('confirm');
						break;
					case 'save':
						if ($this->Item->save()){
							$this->redirect('/items/detail/'.$id);
						}
						break;
				}
			}
		} else {
			$item = $this->Item->find('first', array('conditions' => array('Item.id' => $id)));
			if (! $item){ throw new NotFoundException(); }
			
			$this->request->data['Item'] = $item['Item'];
		}
	}
}
