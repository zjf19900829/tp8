<?php
namespace app\index\controller;
use think\Controller;
use app\index\controller\Base;

class Detail extends Base {
	public function index($id) {
		if(!$id){
			return $this->error('ID不合法');
		}
		$deal=model('deal')->get($id);
		if($deal->status!=1||!$deal){
		return $this->error('该商品不存在');	
			
			
		}
		$category=model('category')->get($deal->category_id);
		//dump($category);exit;
		return $this->fetch('',[
				'title'=>$deal->name,
				'category'=>$category,
				]);
	}
	
	
	
	
	
}
