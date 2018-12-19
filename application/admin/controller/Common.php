<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\controller\Auth;
use think\Request;
class Common extends Controller
{
  /**
   * 判断session登录
   */
  public function _initialize(){
    if(!session('id') || !session('user')){
      $this->error('你尚未登录系统','login/index');
    }
    //权限判断
    $auth = new Auth();
    //获取当前控制器当前方法
    $request=Request::instance();
    //当前控制器
    $con = $request->controller();
    //当前方法
    $action = $request->action();
    $name = $con . '/' . $action;
    $notCheck = array('Index/index','Admin/logout');
    if(!in_array($name,$notCheck)){
      // if(!$auth->check($name,session('id'))){
      //   $this->error('没有权限','index/index');
      // }
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