<?php
namespace app\admin\validate;
use think\Validate;
class Link extends Validate
{
  /**
   * 链接验证
   */
  protected $rule = [
    'title'   =>  'unique:link|require|max:25',
    'url'     =>  'url|unique:link|require|max:60',
  ];

  protected $message = [
    'title.unique'    =>  '链接标题不能重复',
    'title.require'   =>  '链接标题不能为空',
    'title.max'       =>  '链接标题不能超过25个字',
    'url.max'         =>  '链接地址不能超过60个字符',
    'url.require'     =>  '链接地址不能为空',
    'url.unique'      =>  '链接地址不能重复',
    'url.url'         =>  '链接地址格式不正确',
  ];

  protected $scene = [
    'add'   =>  ['title'=>'unique:link|max:25','url'],
    'edit'  =>  ['title','url'],
  ];
}

?>