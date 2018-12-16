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
      if($data['values']){
        $data['values']=str_replace('，',',',$data['values']);
      }
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
    $confres = ConfModel::paginate(10);
    $this->assign('conf',$confres);
    return view();
  }

  /** 
   * 配置修改
   */
  public function edit(){
    if(request()->isPost()){
      $res = new ConfModel;
      $data = input('post.');
      if($data['values']){
        $data['values'] = str_replace('，',',',$data['values']);
      }
      if($res->save($data,['id'=>input('id')])){
        $this->success('修改成功','lst');
      }else{
        $this->error('修改失败');
      }
      return;
    }
    $conf = db('conf')->find(input('id/d'));
    $this->assign('conf',$conf);
    return view();
  }

  /** 
   * 配置删除
   */
  public function del(){
    $id = input('id/d');
    if(db('conf')->delete($id)){
      $data = [
        'statu' => 200,
        'info'  => '删除成功'
      ];
    }else{
      $data = [
        'statu'   => 400,
        'info'  => '删除失败'
      ];
    }
    return $data;
  }
  /** 
   * 配置项
   */
  public function conf(){
    $confres = db('conf')->select();
    $this->assign('conf',$confres);
    return view();
  }

}
?>