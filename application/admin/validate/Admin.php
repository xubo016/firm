<?php
namespace app\admin\validate;
use think\Validate;
class Admin extends Validate
{
  /**
   * 管理员验证
   */
  protected $rule = [
    'user|用户名'      =>  'unique:admin|require|max:16',
    'password|密码'  =>  'require|min:6|confirm:repassword',
    'email|邮箱'    =>  'require',
  ];

  protected $message = [
    'user.unique'       =>  '管理员名称不能重复',
    'user.require'      =>  '管理员名称不能为空',
    'user.max'          =>  '管理员名称不能超过16个字',
    'password.min'      =>  '密码不能少于6个字符',
    'password.require'  =>  '管理员密码不能为空',
    'password.confirm'  =>  '两次密码不一致',
    'email.require'  =>  '邮箱不能为空',
  ];

  protected $scene = [
    'add'   =>  ['user','password','email'],
    'edit'  =>  ['user','password','email'],
  ];

}
?>