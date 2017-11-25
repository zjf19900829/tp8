<?php
namespace app\index\controller;
use think\Controller;
class User extends Controller
{
    public function login()
    {//判断是否已经登录
    	$user=session('o2o_user','','o2o');
    	if($user){
    		return $this->redirect(url('Index/index'));
    	}
    	if(request()->isPost()){
    		$data=input('post.');
    		//dump($data);exit;
    		$res=model('user')->getdatabyName($data['username']);
     		//dump($res);exit;
    		if(!$res||$res['status']!=1){
    			return $this->error('账户不存在');
    		}
    		if($res['password']!=md5($data['password'].$res['code'])){
    			return $this->error('密码不正确');
    		}
    		$res['last_log_time']=time();
    		model('user')->updataById($res,$res['id']);
    		session('o2o_user',$res,'o2o');
    		return $this->success('登录成功',url('Index/index'));
    	}else{
    		return $this->fetch();
    	}
    	
      
    }
    
    public function register()
    {
    	 if(request()->isPost()){
    	 	$data=input("post.");
    	 	if(!captcha_check($data['verifycode'])){
    	 		return $this->error('验证码不正确');
    	 	}
    	 	//validate验证
    	 	
    	 	if($data['password']!=$data['re_password']){
    	 		return $this->error('两次输入密码不一样');
    	 	}
    	 	$data['code']=mt_rand(100,1000);
    	 	$data['password']=md5($data['password'].$data['code']);
    	 	//dump($data);
    	 	//获取数据库中的数据
    	 	/* $result1=model('User')->getdataBy($data['username']);
    	 	$result2=model('User')->getdataBy($data['email']);
    	 	if($result1){
    	 		return $this->error('用户名已存在，请重新注册');
    	 	}
    	 	if($result2){
    	 		return $this->error('邮箱已注册过，请更换新邮箱');
    	 	} */
    	 	$res=model('User')->add($data);
    	 	//dump($res);exit;
    	 	if(!$res){
    	 		return $this->error('注册失败');
    	 	}else{
    	 		return $this->success('注册成功');
    	 	}
    	 }else{
    	return $this->fetch();
    	 }
    }
    
    
    public function logout(){
    	session(null,'o2o');
    	return $this->redirect(url('user/login'));
    }
  
    
    
    
    
    
    
}
