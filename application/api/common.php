<?php
function show($status,$message,$data=[ ]){
	return [
	'status'=>intval($status),//获取变量的整数值
	'message'=>$message,
	'data'=>$data
	];
	
	
}