<?php
namespace app\admin\controller;
use app\admin\controller\Common;
class Index extends Common{
  /**
   * 首页
   */
  public function index(){
    return view();
  }

  /**
   * 空操作
   */
  public function _empty(){
    $this->redirect('index/index');
  }
}
?>