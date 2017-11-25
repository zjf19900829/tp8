<?php
namespace app\admin\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
    	
       return $this->fetch();
    }
    
    public function welcome()
    {
    	/* \phpmailer\Email::send('1045312031@qq.com','测试文件','学习智商');
    	return '发送邮件成功'; */
    	return $this->fetch();
    }
    
    public function test()
    {
    	$res=\map::getLngLat('北京');
    	return $res;
    }
    
    function map(){
    	return  	\map::staticimage('福州鼓楼大儒世家朗园10栋');
    	
    	
    }
}


