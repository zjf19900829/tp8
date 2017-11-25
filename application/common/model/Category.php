<?php

namespace app\common\model;

use think\Model;

class Category extends Model{
	public function add($data){	
	$data['status']=1;
	//$data['create_time']=time();
	//save方法
	return $this->save($data);
	}
	
	//获取栏目名称
	public function getNormalFirstCategory($parent_id=0){
		//parent_id=1的作用是为了将几个用来当模板
		$data=[
		'status'=>1,
		'parent_id'=>$parent_id
		];
		$order=[
		'listorder'=>'desc',
		'id'=>'desc'
		];
		return $this->where($data)->order($order)->select();
	}
	
	public function getCategoryBypanrentId($parent_id=0){
		//parent_id=1的作用是为了将几个用来当模板
		$data=[
		'status'=>1,
		'parent_id'=>$parent_id
		];
		$order=[
		'listorder'=>'desc',
		'id'=>'desc'
				];
		return $this->where($data)->order($order)->select();
	}
public function getCategoryById($category_id){
	
	return $this->where($data)->find();
	
}

public function getNormalRecommendCategoryByParentId($id=0,$limit=5){
	$data=[
	'parent_id'=>$id,
	'status'=>1,
	];
	$order=[
	'listorder'=>'asc',
	'id'=>'asc',
	];
	$result=$this->where($data)->order($order);
	if($limit){
		$result=$result->limit($limit);
	}
	return $result->select();
	
}

public function getNormalCategoryIdParentId($ids){
	$data=[
	'parent_id'=>['in',implode(',',$ids)],
	'status'=>1,
	];
	$order=[
	'listorder'=>'asc',
	'id'=>'asc',
	];
	$result=$this->where($data)->order($order)->select();
    return $result;
	
	
}


}