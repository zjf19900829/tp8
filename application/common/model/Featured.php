<?php 
namespace app\common\model;
use think\Model;
use think\Controller;
class Featured extends Controller{

public function add($data){
	
	$this->save($data);
	return $this->id;
	
}

public function getFeaturedates($data){
	//$data=['type'=>$tiaojian];
	//echo $this->getLastSql();
	$tp=[
	'type'=>$data,
	'status'=>['neq',-1],
	
	];
	$res=db('featured')->where($tp)->paginate(3);

	return $res;
}

public function save($data){
	
	$res=db('featured')->updata($data);
	return $res;
	
}



}
