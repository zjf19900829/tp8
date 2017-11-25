<?php
namespace app\common\model;
use think\Model;
class BisLocation extends Model{
	protected $autoWriteTimestamp=true;
	public function add($data){
		$data['status']=0;
		$this->save($data);
		return $this->id;
	}
	
	public function getNormalLocationByBisId($bisId,$status=0){
		$data=[
		'status'=>$status,
		'bis_id'=>$bisId,
		];
	
		return $this->where($data)->order('id','osc')->find();
			
			
	}
	
	public function getNormalLocationByBis_Id($bisId,$status=0){
		$data=[
		'status'=>$status,
		'bis_id'=>$bisId,
		];
	
		 $result=$this->where($data)->order('id','osc')->select();
		 return $result;
			
	}
	
	
	
	
	
}