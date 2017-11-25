<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Bis extends Controller{
	private $obj;
	public function _initialize(){
	$this->obj=model('Bis');
		
	}
	
	/*
	 * 商家入驻申请列表
	 * 
	 * */
	public function apply(){
		//获取数据库中的数据
		$bis=$this->obj->getBisByStatus(1);
		//print_r($bis);exit;
		return $this->fetch('',['bis'=>$bis]);	
	}
	
	
	//状态修改
	public function status($status){
		$data=input('get.');
		//dump($data);exit;
		if(db('bis')->update($data)){
			return $this->success('状态更新成功');
		}else{
			return $this->error('状态更新失败');
		}
		
	}
	
	
	
	//修改内容
	public function edit(){
		$data=input('get.');
		//dump($data);exit;
		if(empty($data)){
			return $this->error('ID没有数据');
		}
		//echo strstr("I love Shanghai!","Shangha");exit;
/* 		$source = "hello1,hello2,hello3,hello4,hello5";//按逗号分离字符串
		$hello = explode(',',$source);
		dump($hello);
		echo $hello[1]; */
	
		//需要获取哪些数据库的信息
		// 获取一级城市的数据
		$citys = model ( 'City' )->getNormalCityByParentId ();
		//echo $citys;exit;
		// 获取一级栏目的数据
		$category = model ( 'Category' )->getCategoryBypanrentId ();
		//o2o_bis数据
		$bisData=db('bis')->find($data);
		//dump($bisData);
		//dump($bis);exit;
		//get里面的内容是数组形式
		//这个是账户信息
		/*  $accountData=model('BisAccount')->get('',['bis_id'=>$data,'is_main'=>1]);
		$locationData=model('BisLocation')->get('',['bis_id'=>$data,'is_main'=>1]);	 */
		//$accountData=db('account')->find();
		//$accountData=Db::table('o2o_account')->where(['bis_id'=>$data,'is_main'=>1])->find();
	/* dump($accountData);
	dump($locationData);exit; */
		$accountData=model('BisAccount')->getNormalAccountByBisId('',$data);
		$locationData=model('BisLocation')->getNormalLocationByBisId('',$data);
// 		/dump($locationData);exit;
 		  return $this->fetch('',[
 				'citys'=>$citys,
 				'category'=>$category ,
 				'bisData'=>$bisData,
 				'accountData'=>$accountData,
 				'locationData'=>$locationData,
 				]);  
		
		//echo 'sdsa';
		
		
		
		
		
		
		
	}
	
public function index(){
	$data=$this->obj->getBisByStatus();
	//dump($data);exit;
	return $this->fetch('',['data'=>$data]);
}
	
public function delete(){
	$data=$this->obj->getBisByStatus($status=-1);
	//print_r($data);exit;
	//dump($data);exit;
	return $this->fetch('',['data'=>$data]);
}



}