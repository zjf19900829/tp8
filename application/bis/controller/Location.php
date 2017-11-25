<?php
namespace app\bis\controller;
use think\controller;
class Location extends Base{
	
	
	public function index(){
		//获取数据
		
		$locationData=db('bis_location')->where('status!=-1')->paginate(4);
		//print_r($data);exit;
		return $this->fetch('',['locationData'=>$locationData]);
			
	}
	
	
	
	
	public function add(){
		if(request()->isPost()){
			$data=input('post.');
			//dump($data);exit;
			//获取经纬度
			$lnglat=\Map::getLngLat($data['address']);
			if(empty($lnglat)||$lnglat['status']!=0/* ||$lnglat['result']['precise']!=1 */){
				$this->error('无法获取数据,或匹配的数据不精准');
			}
			$bisId=$this->getLoginUser()->bis_id;
			
			//分店相关信息
			$data['cat']='';
			if(!empty($data['se_category_id'])){
				$data['cat']=implode('|',$data['se_category_id']);
			}
			$locationData=[
			'bis_id'=>$bisId,
			'name'=>$data['name'],
			'logo'=>$data['logo'],
			'tel'=>$data['tel'],
			'contact'=>$data['contact'],
			'category_id'=>$data['category_id'],
			'category_path'=>$data['category_id'].','.$data['cat'],
			'city_id'=>$data['city_id'],
			'city_path'=>empty($data['se_city_id'])?$data['city_id']:$data['city_id'].','.$data['se_city_id'],
			'api_address'=>$data['address'],
			'open_time'=>$data['open_time'],
			'content'=>empty($data['content'])?'':$data['content'],
			'is_main'=>0,//代表分店店信息
			'xpoint'=>empty($lnglat['result']['location']['lng'])?'':$lnglat['result']['location']['lng'],
			'ypoint'=>empty($lnglat['result']['location']['lat'])?'':$lnglat['result']['location']['lat'],
			];
			$locationId=model('BisLocation')->add($locationData);
			if($locationId){
				return $this->success('分店申请成功',url('Location/index'));
			}else{
				return $this->error('分店申请失败');
				
			}
			
			
			
			
		}else{
		// 获取一级城市的数据
		// 这个应用model方法特别注意
		$citys = model ( 'City' )->getNormalCityByParentId ();
		$this->assign ( 'citys', $citys );
		// 获取一级栏目的数据
		$category = model ( 'Category' )->getCategoryBypanrentId ();
		$this->assign ( 'category', $category );		
		return $this->fetch();
		}
	}
	
	
	//修改状态
public function status($status){
		$data=input('get.');
		if(db('bis_location')->update($data)){
			return $this->success('状态更新成功');
		}else{
			return $this->error('状态更新失败');
		}
		
	}
	
	//下架
	public function delete($status){
		$data=input('get.');
		//dump($data);exit;
		if(db('bis_location')->update($data)){
			return $this->success('下架成功');
		}else{
			return $this->error('下架失败');
		}
		
		
	}
	
	
}