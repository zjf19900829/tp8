<?php
namespace app\index\controller;
use think\Controller;
class Lists extends Controller
{
    public function lists()
    {
    	
        return $this->fetch();
    }
}
