<?php
namespace app\admin\validate;
use think\Validate;
class Cate extends Validate
{
  /**
   * 栏目验证
   */
  protected $rule = [
    'catename'    =>  'require|unique:cate|max:10',
  ];

  protected $message = [
    'catename.unique'      =>  '栏目名称不能重复',
    'catename.require'     =>  '栏目名称不能为空',
    'catename.max'         =>  '栏目名称不能超过10个字',
  ];

  protected $scene = [
    'add'   =>  ['catename'],
    'edit'  =>  ['catename'],
  ];
}

?>