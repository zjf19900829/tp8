<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller{
	public $city='';
	
	public function _initialize(){
		//城市列表
		$citys=model('city')->getNormalCitys();
		$this->assign('citys',$citys);
	    $this->getCityname($citys);
	    $this->assign('city',$this->city);
	   // dump($this->city);exit;
	    $login=$user=session('o2o_user','','o2o');
	    $cats=$this->getrecommendCats();
	    //print_r($cats);exit;
	    $this->assign('cats',$cats);
	    $this->assign('login', $login);
	    $this->assign('controller',strtolower(request()->controller()));
	    $this->assign('title','o2o团购');
		
		
	
		
		//默认选择的城市is_default=1		
		//$city=model('city')->getDataCitys();
	/* 	foreach($citys as $city){
			$city=$city->toArray();
			if($city['is_default']==1){
				$defaultcity=$city['name'];
				break;
			}			
		}
		//dump($defaultcity);
		$data=$this->getCityname();		
		$data=$data['name'];
		//$data=[];
		//dump($data);
		//$defaultcity=empty($data)?$defaultcity:$data;
		//dump($defaultcity);exit;
		if(!$data){
			$this->assign('defaultcity',$defaultcity);
			return $this->fetch(index/index);
		}else{
		$this->assign('defaultcity',$data);
		return $this->fetch(index/index);
		//print_r($city);exit;
		} */
	}
	
	//获取默认的城市值
	 public function getCityname($citys){
	 /* 	if(!request()->isGet()){
		$data=input('get.');
		//dump($data);
		$result=model('City')->getNormalCityById($data['id']);
	   // dump($result);
		return $result;
	 	} */
	 	
	 	foreach($citys as $city){
	 	$city=$city->toArray();
	 	if($city['is_default']==1){
	 		//$defaultuname=$city['is_default'];
	 		$defaultuname=$city['uname'];
	 		break;
	 	}	 	
	 	}
	 	
	 	$defaultuname=$defaultuname?$defaultuname:"najing";
	 	//dump($defaultuname);
	 	if(session('cityuname','','o2o')&&!input('get.city')){
	 		$cityuname=session('cityuname','','o2o');
	 		//dump($cityuname);
	 	}else{
	 	$cityuname=input('get.city',$defaultuname,'trim');
	 	//dump($cityuname);
	 	session('cityuname',$cityuname,'o2o');
	 	}
	 	//dump($cityuname);//==1???
	 	$this->city=model('City')->where(['uname'=>$cityuname])->find();
	 	//dump($this->city);
	 	//echo "fdsfds";
	}    
	
	/*
	 * 获取首页中推荐位中的商品分类数据
	 * 
	 * **/
	public function getrecommendCats(){
		$parentIds=$secatArr=$recomCats=[];
		//0是parent_id=0,5是显示5条数据
		$cats=model('category')->getNormalRecommendCategoryByParentId(0,5);
		//$result=$result->toArray();
		//dump($result);exit;
		foreach($cats as  $cat){
			$parentIds[]=$cat->id;
		}
	$seCats=model('category')->getNormalCategoryIdParentId($parentIds);
	
	foreach($seCats as $seCat){
		//二级数据
		$secatArr[$seCat->parent_id][]=[
		'id'=>$seCat->id,
		'name'=>$seCat->name,		
		];
		
	}
		foreach($cats as $cat){
			//代表整个一级和二级数据
			//第一个[]代表一级分类的名字,第二个[]代表一级分类下二级子类
			//$secatArr[$cat->id]代表parent_id
			$recomCats[$cat->id]=[$cat->name,
			empty($secatArr[$cat->id])?'':$secatArr[$cat->id]];		
		}
		return $recomCats;
		
	}
	
}