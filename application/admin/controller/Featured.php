<?php
namespace app\admin\controller;
use think\Controller;
class Featured extends Controller{
	private $obj;
	public function _initialize(){
	$this->obj=model('Featured');
	}
	
	public function index(){
		//获取数据 	
	   $data=input('get.type');//这个很重要，直接取出后面的值
	   //dump($data);
       $types= config('featured.featured_type');
       $type= empty($data)?'':$data;
		$featured=$this->obj->getFeaturedates($type);
		return $this->fetch('',['featured'=>$featured,'types'=>$types]);
		
		
	}
	
	
	public function add(){
		if(request()->isPost()){
			$data=input('post.');
			$res=$this->obj->add($data);
			if($res){
				return $this->success('成功添加');
			}
		}
		//获取信息
		//$data=input('post.');
		//dump($data);
		$types=config('featured.featured_type');
		//dump($types);exit;	
		return $this->fetch('',['types'=>$types,]);
	
	
	}
	
 	public function status(){
		$data=input('get.');
		if(db('featured')->update($data)){
			return $this->success('更新成功');
		}
		return $this->error('更新失败');
	}
	 
	
	
	//删除
	public function delete(){
	$data=input('get.');
	if(db('featured')->update($data)){
		return $this->success('删除成功');	
	}
	return $this->error('删除失败');
	}
}