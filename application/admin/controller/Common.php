<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\controller\Auth;
use think\Request;
use think\Db;
class Common extends Controller
{
  /**
   * 判断session登录
   */
  public function _initialize(){
    if(!session('id') || !session('user')){
      $this->error('你尚未登录系统','login/index');
    }
    $auth = new Auth();
    //获取当前控制器当前方法
    $request=Request::instance();
    //当前控制器
    $con = $request->controller();
    //当前方法
    $action = $request->action();
    $name = $con . '/' . $action;
    $notCheck = array('Index/index','Admin/logout');
    $Superadmin = Db::query("select a.id from qy_admin a inner join qy_auth_group_access b on a.id = b.uid inner join qy_auth_group c on b.group_id = c.id where title = '超级管理员'");
    foreach($Superadmin as $k => $v){
      $SuperAdminId[] = $v['id'];
    }
    //权限判断
    if(!in_array(session('id'),$SuperAdminId)){
      if(!in_array($name,$notCheck)){
        if(!$auth->check($name,session('id'))){
          $this->error('没有权限','index/index');
        }
      }
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