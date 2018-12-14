<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\Cate as CateModel;
class Cate extends Common
{
  /**
   * 前置操作
   */
  protected $beforeActionList = [
    'delsoncate'  =>  ['only'=>'del'],
  ];

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
    $code = $cate->catetree();
    $this->assign("value",$code);
    return view();
  }

  /**
   * 栏目列表
   */
  public function lst(){
    $cate = new CateModel;
    $res = $cate->catetree();
    $this->assign('cate',$res);
    return view();
  }

  /**
   * 栏目删除
   */
  public function del(){
    $del = db('cate')->delete(input('id'));
    if($del){
      $this->success('删除成功');
    }else{
      $this->error('删除失败');
    }
  }

  /**
   * 无限极删除
   */
  public function delsoncate(){
    $cateid = input('id'); //要删除的当前栏目id
    $cate = new CateModel;
    $son = $cate->getchilrenid($cateid);
    if($son){
      db('cate')->delete($son);
    }
  }

  /**
   * 栏目修改
   */
  public function edit($id){
    $cate = new CateModel;
    if(request()->isPost()){
      $data = input('post.');
      $save = $cate->save($data,['id'=>input('id')]);
      if($save){
        $this->success('修改成功','lst');
      }else{
        $this->error('修改失败');
      }
      return;
    }
    $code = $cate->catetree();
    $res = db('cate')->find($id);
    if(!$res){
      $this->error('栏目不存在');
    }
    $this->assign(array('cate'=>$code,'res'=>$res));
    return view();
  }

}
?>