<?php
class Item extends AppModel{
	var $name = 'Item';
	var $validate = array(
		'name' => array(
			array(
				'rule' => 'notEmpty', 
				'message' => 'nameは必須です。'
			)
		), 
		'price' => array(
			array(
				'rule' => array('naturalNumber', true),
				'message' => 'priceは整数で入力してください。'
			), 
		), 
	);
}