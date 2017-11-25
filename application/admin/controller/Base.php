<?php
namespace app\admin\controller;
use think\Controller;
class Base extends Controller{
	public $account;
	public function _initialize(){
		//判断用户是否登录
		$isLogin=$this->isLogin();
		if(!$isLogin){
			return $this->redirect(url('admin/Login/index'));
		}
				
	}
	
	public function isLogin(){
		//获取session
		$user=$this->getLoginUser();
		if($user&&$user->id){
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
	
	
	/* public function status(){
		$data=input('get.');
		if(!$data['id']){
			return $this->error('ID不合法');
		}
		if(!is_numeric($data['status'])){
			return $this->error('status不合法');
		}
		//获取控制器
		$model=request()->controller();
		$result=$this->model($model)->save(['status'=>$data['status'],'id'=>$data['id']]);
		if($result){
			return $this->success('更新成功');
		}
		return $this->error('更新失败');
		
	} */
	
}
