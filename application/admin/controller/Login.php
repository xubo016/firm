<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
class Login extends Controller
{
  /**
   * 管理员登录
   */
  public function index(){
    // $this->check_verify(input('code'));
    $admin = new Admin();
    if(request()->isPost()){
      $num = $admin->login(input('post.'));
      if($num == 1){
        $this->error('用户不存在');
      }
      if($num == 2){
        $this->success('登录成功','Index/index');
      }
      if($num == 3){
        $this->error('密码错误');
      }
      return;
    }
    return view();
  }

  /**
   * 验证码验证
   */
  // function check_verify($code){
    // $captcha = new Captcha();
    // $res = $captcha->check($code);
    // if(!$res){
    //   $this->error('验证码错误');
    // }else{
    //   return true;
    // }
  // }
  
  /**
   * 空操作
   */
  public function _empty(){
    $this->redirect('index/index');
  }
}
?>