<?php
namespace app\common\model;
use think\model;
class User extends BaseModel {
	public function add($data) {
		$data ['status'] = 1;
		return $this->allowField ( true )->save ( $data );
	}
	
	public function getdatabyName($data){
		$datas=['username'=>$data,];
		$res=db('user')->where($datas)->find();
		return $res;
		
		
		
	}
	
	
	
	
}

	
