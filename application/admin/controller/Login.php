<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
class Login extends Controller
{
  public function index(){
    $admin = new Admin();
    if(request()->isPost()){
      $num = $admin->login(input('post.'));
      if($num == 1){
        $this->error('用户不存在');
      }
      if($num == 2){
        $this->error('登录成功');
      }
      if($num == 3){
        $this->error('密码错误');
      }
      return;
    }
    return view();
  }
}
?>