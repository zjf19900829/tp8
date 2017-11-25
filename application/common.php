<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


function status($status){
	if($status==1){
		$str="<span class='label label-success radius' >正常</span>";
	}elseif($status==0){
		$str="<span class='label label-waitting radius' >待审</span>";	
	}elseif($status==-1){
		$str="<span class='label label-fault radius' >删除</span>";	
	}	
	return $str;	
}


//$type=0 get方式 $type=1 post方式
function doCurl($url,$type=0,$data=[]){
	$ch=curl_init();// curl_init()函数的作用初始化一个curl会话，
	//curl_init()函数唯一的一个参数是可选的，表示一个url地址。
	
	//设置选项
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_HEADER,0);//输出header头，0表示不需要输出header头
	
	if($type==1){
		//post
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data);		
	}
	
	//执行并获取内容
	$output=curl_exec($ch);
	//释放curl句柄
	curl_close($ch);
	return $output;
}


//商户入驻的申请文案
function bisRegister($status){
	if($status==1){
		$str="入驻申请成功";
	}elseif($status==0){
		$str="待审核，审核后平台会发送邮件给您，请等待";
	}elseif($status==2){
		$str="提交的材料不符合要求，请重新提交";
	}else{
		$str="申请已经被删除";
	}
	return $str;
		
}



/**
 * 
 * 通用的分页样式
 * 
 * **/
function pagination($obj){
	if(!$obj){
		return '';
	}else{	
		return '<div class="cl pd-5 bg-1 bk-gray mt-20  tp5_o2o">'.$obj->render().'</div>';		
	}
	
	
}
	
	
	
	function getSeCityName($data){
		if(empty($data)){
			return '';
		}
		//判断省会后是否有城市名
		$res=strpos($data,',');
		if($res){
			$res=explode(',',$data);
			$cityId=$res[1];
		}else{
			$cityId=$data;
		}
		$city=model('City')->get($cityId);
		return $city->name; 
	}
	

function countLocation($ids){
	
	if(!$ids){
		return 1;
	}
	if(preg_match('/,/',$ids)){
		$arr=explode(',',$ids);
		return count($arr);
		
		
	}
	
	
}






