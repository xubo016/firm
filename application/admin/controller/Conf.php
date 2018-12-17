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
      $validate = \think\Loader::validate('Conf');
      if(!$validate->scene('add')->check($data)){
        $this->error($validate->getError());
      }
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
      $validate = \think\Loader::validate('Conf');
      if(!$validate->scene('edit')->check($data)){
        $this->error($validate->getError());
      }
      if($data['values']){
        $data['values'] = str_replace('，',',',$data['values']);
      }
      $code = $res->save($data,['id'=>input('id')]);
      if($code !== false){
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
    if(request()->isPost()){
      $data = input('post.');
      foreach($data as $k => $v){
        $form[] = $k;
      }
      $enname = db('conf')->field('enname')->select();
      foreach($enname as $k => $v){
        $arr[] = $v['enname'];
      }
      foreach($arr as $k => $v){
        if(!in_array($v,$form)){
          $code[] = $v;
        }
      }
      
      if($code){
        foreach($code as $k => $v){
          ConfModel::where('enname',$v)->update(['value'=>'']);
        }
      }
      if($data){
        foreach($data as $k => $v){
          db('conf')->where('enname',$k)->update(['value'=>$v]);
        }
      }
      $this->success('修改成功');
      return;
    }
    $confres = db('conf')->select();
    $this->assign('conf',$confres);
    return view();
  }

}
?>