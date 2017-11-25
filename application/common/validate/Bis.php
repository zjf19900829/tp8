<?php
namespace app\common\validate;
use think\Validate;
class Bis extends Validate {
	// 验证规则
	protected $rule = [ 
			'name' => 'require|max:25',
			'email' => 'email',
			'logo' => 'require',
			'city_id' => 'require',
			'bank_info' => 'require',
			'bank_name' => 'require',
			'bank_user' => 'require',
			'faren' => 'require',
			'faren_tel' => 'require' 
	]
	;
	// 验证提示
	protected $message = [ 
			'name.require' => '名称必须填写',
			'name.max' => '名称最多不能超过25个字符',
			'emial.email'=>'必须为合法的邮件地址',
		    'logo.require'=>'logo必填',
			'city_id.require'=>'地域名必填',
			'bank_info.require'=>'银行账号必填',
			'bank_name.require'=>'开户行名称必填',
			'bank_user.require'=>'开户行姓名必填',
			'faren.require'=>'法人必填',
			'faren_tel.require'=>'法人联系电话必填',
			
	];
	
	// 验证场景
	protected $scene = [ 
			'add' => [ 
					'name','emial','logo','city_id','banki_info','bank_name',
					'bank_user','faren','faren_tel', 
			],
	];
}