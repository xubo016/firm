<?php
namespace app\admin\validate;
use think\Validate;
class Admin extends Validate
{
  /**
   * 管理员验证
   */
  protected $rule = [
    'user'      =>  'unique:admin|require|max:16',
    'password'  =>  'require|min:6',
  ];

  protected $message = [
    'user.unique'       =>  '管理员名称不能重复',
    'user.require'      =>  '管理员名称不能为空',
    'user.max'          =>  '管理员名称不能超过16个字',
    'password.min'      =>  '密码不能少于6个字符',
    'password.require'  =>  '管理员密码不能为空',
  ];

  protected $scene = [
    'add'   =>  ['user','password'],
    'edit'  =>  ['user','password'=>'min:6'],
  ];
}

?>