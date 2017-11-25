<?php
namespace app\common\model;
use think\Model;
class Bis extends Model{
	protected $autoWriteTimestamp=true;
	public function add($data){
		$data['status']=0;
		$this->save($data);
		return $this->id;
	}
	
	/**
	 * 通过商家状态查询数据
	 * 
	 * */
	public function getBisByStatus($status=0){		
		$order=[
		'id'=>'asc',
		];
		$data=[
		'status'=>$status,
		];
		$res=$this->where($data)->order($order)->paginate(4);
		return $res;	
	}
}