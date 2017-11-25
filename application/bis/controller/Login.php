<?php
namespace app\bis\controller;
use think\Controller;
class Login extends Controller{
	public function index(){
		if(request()->isPost()){
			$data=input('post.');
			$res=Model('BisAccount')->get(['username'=>$data['username']]);	
			//dump($red);exit;				
		//	$res=Model('BisAccount')->findAccountBydata($account);
			if(!$res||$res['status']!=1){
				return $this->error('用户不存在或未审核通过');		
			}
			
			if($res['password']!=md5($data['password'].$res['code'])){
				session('bisAccount',$res,'bis');
				return $this->error('密码不正确');
			}
			session('bisAccount',$res,'bis');
			return $this->success('登陆成功',url('Index/index'));		
			
		}
		return $this->fetch();
		
		
		
	}
	
	
	
	
	
}