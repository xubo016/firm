<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\Cate as CateModel;
class Cate extends Common
{
  /**
   * 栏目添加
   */
  public function add(){
    $cate = new CateModel;
    if(request()->isPost()){
      $res = $cate->addcate(input('post.'));
      if($res){
        $this->success("添加成功");
      }else{
        $this->error("添加失败");
      }
      return;
    }
    $code = $cate->select();
    $this->assign("value",$code);
    return view();
  }

  /**
   * 栏目列表
   */
  public function lst(){
    return view();
  }

}
?>