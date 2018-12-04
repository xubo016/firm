<?php
namespace app\index\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        return '前台首页';
    }
    // 空操作
    public function _empty(){
      $this->redirect('index/index');
    }
    
}