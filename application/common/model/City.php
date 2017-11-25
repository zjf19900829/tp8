<?php
namespace app\Common\model;
use think\Model;
class City extends Model
{
    //
	public function getAllNormalCitys(){
		$data=[
		'status'=>1,
		];
	
		$order=[
		'id'=>'desc',
		];
		return $this->where($data)->order($order)->paginate(4);
	
	
	}
	
    public function getNormalCityByParentId($parent_id=0){
    	$data=[
    	'status'=>1,
    	'parent_id'=>$parent_id,
    	];
    	
    	$order=[
    	'id'=>'desc',
    	];
    	return $this->where($data)->order($order)->select();
    	
    	
    }
    
    public function getNormalCitys(){
    	$data=[
    	'status'=>1,
    	'parent_id'=>['gt',0],
    	];
    	 
    	$order=[
    	'id'=>'desc',
    	];
    	return $this->where($data)->order($order)->select();
    	 
    	 
    }
    
    public function getDataCitys(){
    	$data=[
    	'status'=>1,
    	'parent_id'=>['gt',0],
    	'is_default'=>1
    	];
    
    	$order=[
    	'id'=>'desc',
    	];
    	return $this->where($data)->order($order)->select();
    
    
    }
    
    public function getNormalCityById($id){
    	$data=[
    	'status'=>1,
    	'parent_id'=>['gt',0],
    	'id'=>$id,
    	];
  
    	return db('city')->where($data)->find();
    
    
    }
    
    
    
}
