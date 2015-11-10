<?php
App::uses('AppController', 'Controller');

class ArticlesController extends AppController {
	public $name = 'Articles';
	public $uses = array('Article');
	
	public function show_constants(){
		debug(APP);
		debug(APP_DIR);
		debug(APPLIBS);
		debug(CACHE);
		debug(CAKE);
		debug(CAKE_CORE_INCLUDE_PATH);
		debug(CORE_PATH);
		debug(CSS);
		debug(CSS_URL);
		debug(DS);
		debug(FULL_BASE_URL);
		debug(IMAGES);
		debug(IMAGES_URL);
		debug(JS);
		debug(JS_URL);
		debug(LOGS);
		debug(ROOT);
		debug(TESTS);
		debug(TMP);
		debug(VENDORS);
		debug(WEBROOT_DIR);
		debug(WWW_ROOT);
		debug();
		debug(TIME_START);
	}
	
	public function index(){
		//debug($this->Article->find('list'));
		/*
		$articles = $this->Article->find('all', array('order' => 'Article.id', 'offset' => 10, 'limit' => 10));
		foreach ($articles as $article){ debug($article['Article']['id']); }
		$articles = $this->Article->find('all', array('order' => 'Article.id'));
		foreach ($articles as $article){ debug($article['Article']['id']); }
		*/
		
		$conditions = array();
		
		if ($this->request->data){
			$search = $this->request->data['Search'];
			if ($search['text']){
				$conditions['Article.title like'] = 
					'%'.$search['text'].'%';
			}
			if ($search['is_active']){
				$conditions['Article.is_active'] = true;
			}
		}
		
		$this->paginate = array(
			'Article' => array(
				'page' => 1,
				'limit' => 10,
				'order' => 'Article.created desc', 
				'conditions' => $conditions, 
			), 
		);
		
		$articles = $this->paginate('Article');
		
		$this->set('articles', $articles);
	}
}
