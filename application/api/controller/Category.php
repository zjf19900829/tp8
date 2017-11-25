<?php
namespace app\api\controller;
use think\Controller;
class category extends Controller{
	private $obj;
	public function _initialize(){
		$this->obj=model('Category');
	}
	public function getCategoryBypanrentId(){
		$id=input('post.id',0,'intval');
		if(!$id){
			$this->error('ID不合法');
		}
		$category=$this->obj->getCategoryBypanrentId($id);
		if(!$category){
			return show(0,'error');
		}else{
			return show(1,'success',$category);
		}
	}
	
	
}