<?php
namespace app\admin\controller;
use app\admin\model\Link as LinkModel;
use app\admin\controller\Common;
class Link extends Common
{
  /** 
   * 链接添加
   */
  public function add(){
    if(request()->isPost()){
      $add = db('link')->insert(input('post.'));
      if($add){
        $this->success('添加成功');
      }else{
        $this->error('添加失败');
      }
      return;
    }
    return view();
  }

  /** 
   * 链接列表
   */
  public function lst(){
    $code = new LinkModel;
    $link = $code->paginate(10);
    $this->assign('link',$link);
    return view();
  }

  /** 
   * 链接修改
   */
  public function edit(){
    $code = new LinkModel;
    if(request()->isPost()){
      $res = $code->where('id',input('id'))->update(input('post.'));
      if($res){
        $this->success('修改成功','lst');
      }else{
        $this->error('修改失败');
      }
    }
    $link = $code->find(input('id'));
    $this->assign('link',$link);
    return view();
  }

  /** 
   * 链接ajax删除
   */
  public function del($id){
    $id = input("post.id/d");
    $res = db('link')->where('id',$id)->delete();
    if($res){
      $data = [
        'statu' => 200,
        'info'  => '删除成功'
      ];
    }else{
      $data = [
        'statu' => 400,
        'info'  => '删除失败'
      ];
    }
    return $data;
  }

}
?>