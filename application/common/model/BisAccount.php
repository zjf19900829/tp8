<?php
namespace app\common\model;
use think\Model;
class BisAccount extends Model{
	protected $autoWriteTimestamp=true;
	public function add($data){
		$data['status']=0;
		$this->save($data);
		return $this->id;
	}
	
	public function getNormalAccountByBisId($data){
		$data=[
		'status'=>0,
		'bis_id'=>$data,
		];

		return $this->where($data)->find();	 
	}
	
	public function updataById($data,$id){
		//dump($data);
		//将最后的登录时间进行更新
		//$res=db('BisAccount')->where('id',$data['id'])->update(['last_login_time'=>$data['last_login_time']]);
        return $this->allowField(true)->save($data,$id);
		
		//dump($res);exit;
/* 		if(!$res){
			return  $this->error('数据更新失败'); 
			
		}
		return $res; */
			
	}
	
/* 	public function findAccountBydata($data){
		
		
		return db('bis_Account')->find($data);
		
		
	} */
	
}