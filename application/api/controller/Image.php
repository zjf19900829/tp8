<?php
namespace app\api\controller;
use think\Controller;
use think\File;
use think\Request;
class Image extends Controller {
	public function upload() {
		$file = Request::instance ()->file ( 'file' );
		$info = $file->move ( 'upload' );
		// 判断图片是否上传成功
		if ($info && $info->getPathname ()) {
			return show ( 1, 'success', '/' . $info->getPathname () );
		} else {
			return show ( 0, 'errorupload' );
		}
	}
} 