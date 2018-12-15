<?php
namespace app\admin\validate;
use think\Validate;
class Article extends Validate
{
  /**
   * 文章验证
   */
  protected $rule = [
    'title'    =>  'unique:article|require|max:27',
    'cateid'   =>  'require',
    'centent'  =>  'require',
  ];

  protected $message = [
    'title.unique'      =>  '文章标题不能重复',
    'title.require'     =>  '文章标题不能为空',
    'title.max'         =>  '文章标题不能超过27个字',
    'cateid.require'    =>  '所属栏目不能为空',
    'centent.require'   =>  '文章内容不能为空',
  ];

  protected $scene = [
    'add'   =>  ['title','cateid','centent'],
    'edit'  =>  ['title','cateid','centent'],
  ];
}

?>