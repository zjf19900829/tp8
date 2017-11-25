<?php
namespace app\admin\controller;
use think\Controller;
class City extends Controller{
	private $obj;
	public function _initialize(){
		$this->obj=model('City');
	
	}
	
	public function index(){
		$citydata=$this->obj->getAllNormalCitys();
	
	    return $this->fetch('',['citydata'=>$citydata]);
		
	}
	
	
	public function edit(){
		$id=input('get.');
		$citydata=db('city')->find($id);
		//dump($data);exit;
		return $this->fetch('',['citydata'=>$citydata]);
		
		
		
	}
	
	
	
	
	
}
	
	
	
