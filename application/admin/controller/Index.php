<?php
namespace app\admin\controller;
class Index{
  public function index(){
    return view();
  }
  // 空操作
  public function _empty(){
    $this->redirect('index/index');
  }
}
?>