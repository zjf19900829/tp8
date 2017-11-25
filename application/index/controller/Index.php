<?php
namespace app\index\controller;
use think\Controller;
use app\index\controller\Base;
class Index extends Base
{
    public function index()
    {
    	//查询商品分类、数据-美食、推荐的商品
    	//dump($this->city);exit;   =>null
    	$datas=model('Deal')->getNormalDealByCategoryCityId('1',$this->city->id);
    	$meishicates=model('category')->getNormalRecommendCategoryByParentId(1,4);
    	
       return $this->fetch('',['datas'=>$datas,'meishicates'=>$meishicates]);
    }
    
    public function welcome()
    {
    	return $this->fetch();
    }
}
