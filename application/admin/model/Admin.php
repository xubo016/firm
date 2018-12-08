<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model
{
  
  /**
   * 添加数据
   */
  public function addadmin($data){
    //判断传递的值不为空并且是数组
    if(empty($data) || !is_array($data)){
      return false;
    }
    //md5()加密密码
    if($data['password']){
      $data['password'] = md5($data['password']); 
    }
    //执行添加
    $res = $this->save($data);
    //判断是否添加成功
    if($res){
      return true;
    }else{
      return false;
    }
  }

  /**
   * 分页查询数据
   */
  public function getadmin(){
    return $this::paginate(10);
  }

  /**
   * 登录
   */
  public function login($data){
    $admin = Admin::get(['user'=>$data['user']]);
    if($admin){
      if($admin['password']==md5($data['password'])){
        session('id',$admin['id']);
        session('user',$admin['user']);
        return 2; //登录密码正确 
      }else{
        return 3; //登录密码错误
      }
    }else{
      return 1; //用户不存在
    }
  }
}
?>