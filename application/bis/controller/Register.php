<?php

namespace app\bis\controller;

use think\Controller;
use think\Request;
use app\common\model\BisAccount;

class Register extends Controller {
	public function index() {
		// 获取一级城市的数据
		// 这个应用model方法特别注意
		$citys = model ( 'City' )->getNormalCityByParentId ();
		$this->assign ( 'citys', $citys );
		// 获取一级栏目的数据
		$category = model ( 'Category' )->getCategoryBypanrentId ();
		$this->assign ( 'category', $category );
		return $this->fetch ();
	}
	public function add() {
		if (! request ()->isPost ()) {
			$this->error ( '请求错误' );
		}
		//获取表单值
		$data = input ( 'post.' );
		//dump($data);
		//检验数据
		$validate = validate ( 'Bis' );
		if (! $validate->scene ( 'add' )->check ( $data )) {
			$this->error ( $validate->getError () );
		}
		//获取经纬度
		$lnglat=\Map::getLngLat($data['address']);
		if(empty($lnglat)||$lnglat['status']!=0/* ||$lnglat['result']['precise']!=1 */){
			$this->error('无法获取数据,或匹配的数据不精准');
		}
  // $res=db('o2o_bis_account')->find($data['username']);
  //获取$data['username']数据
  $res=Model('BisAccount')->get(['username'=>$data['username']]);
 //print_r($res);die();
		if($res){
			$this->error('账号已存在，请从新注册');
		}		
		//商户基本信息入库
		$bisData=[
		'name'=>$data['name'],
		'city_id'=>$data['city_id'],
		'city_path'=>empty($data['se_city_id'])?$data['city_id']:$data['city_id'].','.$data['se_city_id'],
		'logo'=>$data['logo'],
		'licence_logo'=>$data['licence_logo'],
		'description'=>empty($data['description'])?'':$data['description'],
		'bank_info'=>$data['bank_info'],
		'bank_user'=>$data['bank_user'],
		'bank_name'=>$data['bank_name'],
		'faren'=>$data['faren'],
		'faren_tel'=>$data['faren_tel'],
		'email'=>$data['email'],
		];
		$bisId=model('bis')->add($bisData);
	//dump($bisId);	
		//总店相关信息
		$data['cat']='';
		if(!empty($data['se_category_id'])){
			$data['cat']=implode('|',$data['se_category_id']);			
		}
		$locationData=[
		'tel'=>$data['tel'],
		'contact'=>$data['contact'],
		'category_id'=>$data['category_id'],
		'category_path'=>$data['category_id'].','.$data['cat'],
		'city_id'=>$data['city_id'],
		'city_path'=>empty($data['se_city_id'])?$data['city_id']:$data['city_id'].','.$data['se_city_id'],
		'api_address'=>$data['address'],
		'open_time'=>$data['open_time'],
		'content'=>empty($data['content'])?'':$data['content'],
		'is_main'=>1,//代表总店信息
		'xpoint'=>empty($lnglat['result']['location']['lng'])?'':$lnglat['result']['location']['lng'],
		'ypoint'=>empty($lnglat['result']['location']['lat'])?'':$lnglat['result']['location']['lat'],		
		];
		$locationId=model('BisLocation')->add($locationData);
		//echo $locationId;
		//账户信息
		//自动生成字符串加密码
		$data['code']=mt_rand(100,1000);
		$accountData=[
		'username'=>$data['username'],		
		'bis_id'=>$bisId,
		'code'=>	$data['code'],
		'password'=>md5($data['password'].$data['code']),
		'is_main'=>1,//代表总店信息
		];		
		$accountId=model('BisAccount')->add($accountData);
		if(!$accountId){
			$this->error('申请失败');
		}
		//信息注册成功，发送信息给用户
		$url=request()->domain().url('bis/Register/waiting',['id'=>$bisId]);
		$title="o2o入驻申请通知";
		$content="您提交的信息正在审核，您刻印通过点击链接<a href='".$url."'
				target='_blank'>查看链接</a>实时关注审核进度";
		\phpmailer\Email::send($data['email'],$title,$content);	
		$this->success('申请成功',url('Register/waiting',['id'=>$bisId]));
		
		
	}
				
		 public function  waiting($id){
			if(empty($id)){
				$this->error('error');
			}
			$details=model('Bis')->get($id);
			/* echo $details;
			echo "<hr/>";
			print_r($details);
			echo "<hr/>";
			dump($details);//exit; */
			$this->assign('details',$details);
			return $this->fetch();
		}
		
		
		
	
}