<?php
namespace app\admin\controller;
use think\Controller;
class Category extends Controller
{
	private $obj;
	public function _initialize(){
	$this->obj=model('Category');
		
	}
    public function index()
    {   $res=input('parent_id');
 $order=[
    	'listorder'=>'asc',
    	'id'=>'asc'
    	];
    	//$do=input('get.parent_id',0,'intval');//如果有数据传入，则是parent_id,否则是0     
    	if($res){   
    	$data=db('category')->where("parent_id=$res")->order($order)->paginate(4);
    	}else{
    		$data=db('category')->order($order)->paginate(4);
    	}
    	$this->assign('data',$data);
       return $this->fetch();
    }
    
    public function add()
    {
    	$category=$this->obj->getNormalFirstCategory();
    	$this->assign('category',$category);
    	return $this->fetch();   	
    }
    
    public function save()
    {
    	//先判断是否有数据传入
    	if($_POST){
    	//获取数据
    	$data=[
    	'name'=>input('name'),
    	'parent_id'=>input('parent_id')
    	];
    	}
    	$data['create_time']=time();
    	$data['update_time']=time();
    	//时间戳
    $data['create_time']=time();
    	//实例化validata方法
    	//$validate =Loader::validate('Category');
    	//这一块不知道哪里出问题了
    	/*   if(!$validate->scene('add')->check($data)){
    		return $this->error($validate->getError());
    	}   */
    	//实例化add方法
    	//$res=model('Category')->add($data);
    	$res=$this->obj->add($data);
    	if($res){
    		return $this->success('成功添加数据','Category/index');
    	}else{
    		return $this->error('添加数据失败');
    	}
    	//$res=Db::name('category')->insert($data);
    	//dump($res);exit;
    }
    
    
    
    public function edit(){
     	//查找id的数据
    	$data_id=['id' =>input('id')];   	
    	$data=db('category')->find($data_id);   	
    	$this->assign('data',$data);
    	//dump($data);
    	//查找name的子类
    	//$data_parent=['parent_id' =>input('id')];   
    	$data_parent['id']=$data['parent_id'];
    	//dump($data_parent);exit;
    	$parent_data=db('category')->where($data_parent)->find();
    	$this->assign('parent_data',$parent_data);
    	//dump($parent_data);exit;
    	//所有parent_id=0的子类
    	$category=$this->obj->getNormalFirstCategory();
    	$this->assign('category',$category);	
    	return $this->fetch();
    	 	
    }
    
    
    public function doEdit(){
    	$data=[
    	'id'=>input('id'),
    	'name'=>input('name'),
    	'parent_id'=>input('parent_id')
    	];
    	//dump($data);
    	$res=db('category')->where($data)->find();   	
    	//echo db()->getLastSql();
    	//dump($res);exit;
    	if($res){   		
    		//如果查询到数据，则没有更改数据
    		//return $this->fetch('Category/index');
    		return $this->error('未做修改');
    	}else{
    		$data['update_time']=time();   		
    	}
    	
    	$res=db('category')->update($data);
    	if($res){
    		return $this->success('修改成功','Category/index');
    	}else{
    		return $this->error('修改失败');  		
    	}
        	
    }
    
    public function delete(){
    	$data=[
    	'id'=>input('id'),
    	];
    	if(db('category')->delete($data)){
    		return $this->success('删除成功','category/index');
    	}else{
    		return $this->error('修改失败');  		
    	}
    	
    	
    }
    
    //排序逻辑
    public function listorder($id,$listorder){
    	$data=[
    	'listorder'=>input('listorder'),
    	'id'=>input('id'),
    	];
    	$order=[
    	'listorder'=>'desc',
    	'id'=>'desc'
    	];
    	$res=db('category')->order($order)->update($data);
    	if($res){//$_SERVER['HTTP_REFERER']:获取上一个页面的URL地址
    		$this->result($_SERVER['HTTP_REFERER'],1,'success');
    	}else{
    		$this->result($_SERVER['HTTP_REFERER'],0,'更新失败');
    	}
    	
    }
    
    public function status(){
    	//dump(input('get.'));
    	//{:url('category/status',['id'=>$v.id,'status'=>$v.status==1?0:1])}url通过get获取数据
    	$data=input('get.'); 
    	//dump($data);exit;
    	$validate =validate('Category');
    	   if(!$validate->scene('status')->check($data)){
    	 return $this->error($validate->getError());
    	}
    	if(db('category')->update($data)){
    		return $this->success('状态更新成功');
    	}else{
    		return $this->error('状态更新失败');
    	}
    	
    	
    	
    	
    	
    }
    
}