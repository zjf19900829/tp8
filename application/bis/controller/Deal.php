<?php

namespace app\bis\controller;

class Deal extends Base{
	
	public function index(){
		//搜索数据传送的值
		$data=input('get.');
		$datas=[];
		/* 'category_id'=>empty($data['category_id'])?'':$data['category_id'],
		'city_id'=>empty($data['city_id'])?'':$data['city_id'],
		'start_time'=>empty($data['start_time'])?'':strtotime($data['start_time']),
		'end_time'=>empty($data['end_time'])?'':strtotime($data['end_time']),
		'name'=>"%".$data['name']."%",
		]; */
		if(!empty($data['category_id'])){
		$datas['category_id']=$data['category_id'];	
		}
		if(!empty($data['city_id'])){
			$datas['city_id']=$data['city_id'];
		}
		if(!empty($data['start_time'])&&!empty($data['end_time'])&&strtotime($data['start_time'])<strtotime($data['end_time'])){
			$datas['create_time']=[
			['gt',strtotime($data['start_time'])],
			['lt',strtotime($data['end_time'])]
			];
		}
		if(!empty($data['name'])){
			$datas['name']=['like','%'.$data['name'].'%'];
		}
		$datas['status']=1;
		$deal=Model('Deal')->getDealDataBydatas($datas);
		//dump($deal);exit;
		//dump($shuju);exit;
		
		
		
		
		
		//查询数据
		 //$deal=Model('Deal')->getDealData();
		//$category=$deal['category_id']; 
		$categorys=Model('Category')->getNormalFirstCategory();
		//美食分类
		$categoryArrs=$cityArrs=[];
		foreach($categorys as $category){
			$categoryArrs[$category->id]=$category->name;
		}
		//城市全部分类
		$citys=Model('City')->getAllNormalCitys();
		foreach($citys as $city){
			$cityArrs[$city->id]=$city->name;
		}
		//购买件数
		//小城市分类
		//$citysmall=Model('City')->getNormalCitys();
		return $this->fetch('',['deal'=>$deal,
				'categoryArrs'=>$categoryArrs,
				'cityArrs'=>$cityArrs,
				'categorys'=>$categorys,
				'citys'=>$citys,
				]);
	}
	
	public function add(){
		$bisId=$this->getLoginUser()->bis_id;
		if(request()->isPost()){
		//validate检测数据是否合法,省略
			$data=input('post.');
			//dump($data);exit;
		$location=model('BisLocation')->get($data['location_ids'][0]);
		
		$deals=[
		'name'=>$data['name'],
		'city_id'=>$data['city_id'],
		'se_city_id'=>empty($data['se_city_id' ])?'':$data['se_city_id' ],
		'category_id' => $data['category_id'],
		'se_category_id' =>empty($data['se_category_id' ])?'':implode(',',$data['se_category_id' ]),
		'location_ids' =>empty($data['location_bis' ])?'':implode(',',$data['location_bis' ]),
		'image'=>$data['image'],
		'start_time'=>strtotime($data['start_time']),
		'end_time' =>strtotime($data['end_time']),
		'coupons_begin_time' =>strtotime($data['coupons_begin_time']),
		'coupons_end_time' => strtotime($data['coupons_end_time']),
		'total_count' =>$data['total_count'],
		'origin_price' => $data['origin_price'],
		'current_price' => $data['current_price'],
		'description' =>$data['description'],
		'notes'=>$data['notes'],
		'bis_account_id'=>$this->getLoginUser()->id,
		'xpoint'=>$location->xpoint,
		'ypoint'=>$location->ypoint,
		];
		$id=model('Deal')->add($deals);
		if($id){
			return $this->success('成功添加',url('Deal/index'));
		}else{
			return $this->success('添加失败');	
		}	
			
		}
		else{
		
		//$bisId是什么，是不是session中的登录id
		$bisId=$this->getLoginUser()->bis_id;
		//获取一级城市的数据
		$citys = model ( 'City' )->getNormalCityByParentId ();		
		// 获取一级栏目的数据
		$categorys = model ( 'Category' )->getCategoryBypanrentId ();
	/* 	$res=model('BisLocation')->getNormalLocationByBis_Id($bisId);
		dump($res);exit; */
		return $this->fetch('',['citys'=>$citys,
				'categorys'=>$categorys,
				'bislocations'=>model('BisLocation')->getNormalLocationByBis_Id($bisId,$status=0),
				]);
	}
	}
	
	
	
	
	public function status(){
		$data=input('get.');
		if(db('deal')->update($data)){		
			return $this->success('更新成功');
		}else{
			return $this->error('更新失败');
		}
	
}



public function category_id(){
	
	
	
	
	
	
}
}