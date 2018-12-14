<?php
namespace app\admin\controller;
use think\Controller;
class Common extends Controller
{
  /**
   * 判断session登录
   */
  public function _initialize(){
    if(!session('id') || !session('user')){
      $this->error('你尚未登录系统','login/index');
    }
  }

  /**
   * 空操作
   */
  public function _empty(){
    $this->redirect('index/index');
  }
  
}
?>