<?php
namespace app\common\model;
use think\Model;
class Deal extends BaseModel{
	
	//查询数据
	public function getDealData(){
	$data=db('deal')->where('status!=-1')->order('id','osc')->paginate(4);
	return $data;
	}
	
	public function getDealDataBydatas($datas){
		
		$data=db('deal')->where($datas)->order('id','osc')->paginate(4);
		return $data;
	}
		
		
		public function getNormalDealByCategoryCityId($id,$cityId,$limit=10){
			$data=[
			'id'=>$id,
			'end_time'=>['gt',time()],
			'city_id'=>$cityId,
			'status'=>1,	
			];
			
			$order=[
			'listorder'=>'osc',
			'id'=>'osc',
			];
			
		$result=$this->where($data)->order($order);
			if($limit){
				$result=$result->limit($limit);
			}
           return $result->select();
			
			
		}

		
		
		
		
		
		
		
}