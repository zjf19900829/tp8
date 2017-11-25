<?php
namespace app\admin\validate;
use think\Validate;
class Category extends Validate{
	//验证规则
	protected $rule = [
	'name'  =>  'require|max:25|alphaDash|unique:admin',
	'parent_id' => 'require',
	'status'=>'number|in:-1,0,1',
			'listorder'=>'number',
			'id'=>'number'
	];
	//验证提示
	protected $message  =   [
	'id'=>'ID必须为数字',
	'name.require' => '名称必须填写',
	'name.max'     => '名称最多不能超过25个字符',
	'name.alphaDash'     => '名称最字段必须由字母和数字，下划线_及破折号-',
	'name.unique:admin'     => '名称必须由唯一',
	'parent_id.require'=>'密码必须填写',
			'status.number'=>'状态必须是数字',
			'status.in'=>'状态范围不合法',
			'listorder.number'=>'排序必须是数字'
	];
	
	//验证场景
	protected $scene = [
	'add'  =>  ['name','parent_id'],
	'edit'  => ['name','parent_id'],
	'save'  => ['name','parent_id'],
	'status'=>['status','id']
	];
}