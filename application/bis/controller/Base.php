<?php
namespace app\bis\controller;
use think\Controller;
class Base extends Controller{
	public $account;
	public function _initialize(){
		//判断是否登录过
		if(!$this->isLogin()){
			return $this->redirect(url('Login/index'));
		}
		
		
	}
	
public function isLogin(){
	//判断session值
	$zhi=$this->getLoginUser();
	if($zhi&&$zhi->id){
		return true;
	}
	return false;
	
}	
	
public function getLoginUser(){
	if(!$this->account){
	$this->account=session('bisAccount','','bis');
	}
	return $this->account;
	
}
	
	
	
}