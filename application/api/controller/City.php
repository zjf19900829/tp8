<?php
namespace app\api\controller;
use think\Controller;
class City extends Controller
{
	private $obj;
	public function _initialize(){
		$this->obj=model('City');//这个是什么意思
		
	}
 public function getNormalCityByParentId(){
 	$id=input('post.id');
 	if(!$id){
 		return $this->error('ID不合法');
 	}
 	$citys=$this->obj->getNormalCityByParentId($id);
 	//dump($citys);exit;
 	if(!$citys){
 		return show(0, 'error');
 	}
 	return show(1,'success',$citys);
 }
}