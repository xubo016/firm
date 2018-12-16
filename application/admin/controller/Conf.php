<?php
namespace app\admin\controller;
use app\admin\model\Conf as ConfModel;
use app\admin\controller\Common;
class Conf extends Common
{
  /** 
   * 配置添加
   */
  public function add(){
    $conf = new ConfModel;
    if(request()->isPost()){
      $data = input('post.');
      if($conf->save($data)){
        $this->success('添加成功');
      }else{
        $this->error('添加失败');
      }
      return;
    }
    return view();
  }

  /** 
   * 配置列表
   */
  public function lst(){
    return view();
  }

  /** 
   * 配置修改
   */
  public function edit(){
    return view();
  }

}
?>