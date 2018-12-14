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
    $admin = new Admin();
    if(request()->isPost()){
      $num = $admin->login(input('post.'));
      $data = $this->check_verify(input('code'));
      if(!$data){
        $this->error('验证码错误');
      }
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
  function check_verify($code=''){
    $captcha = new \think\captcha\Captcha();
    if (!$captcha->check($code)) {
      return false;
    }else{
      return true;
    }
  }
  
  /**
   * 空操作
   */
  public function _empty(){
    $this->redirect('login/index');
  }
}
?>