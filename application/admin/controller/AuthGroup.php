<?php
namespace app\admin\controller;
use app\admin\Controller\Common;
use app\admin\model\AuthGroup as AuthGroupModel;
use app\admin\model\AuthRule as AuthRuleModel;
class AuthGroup extends Common
{
  /**
   * 用户组添加
   */
  public function add(){
    if(request()->isPost()){
      $data = input('post.');
      if(!isset($data['status'])){
        $data['status'] = 0;
      }
      if(isset($data['rules'])){
        $data['rules']=implode(',',$data['rules']);
      }else{
        $data['rules']='';
      }
      $AuthGroupModel = new  AuthGroupModel();
      if($AuthGroupModel->save($data)){
        $this->success('添加成功');
      }else{
        $this->error('添加失败');
      }
      return;
    }
    $AuthRule = new AuthRuleModel();
    $AuthRuleModel = $AuthRule->AuthRuleTree();
    $this->assign('AuthRule',$AuthRuleModel);
    return view();
  }

  /** 
   * 用户组列表
   */
  public function lst(){
    $AuthGroupModel = new  AuthGroupModel();
    $AuthGroup = AuthGroupModel::paginate(10);
    $this->assign('AuthGroup',$AuthGroup);
    return view();
  }

  /** 
   * 用户组修改
   */
  public function edit(){
    if(request()->isPost()){
      $data = input('post.');
      if(!isset($data['status'])){
        $data['status'] = 0;
      }
      if(isset($data['rules'])){
        $data['rules']=implode(',',$data['rules']);
      }else{
        $data['rules']='';
      }
      $code = db('Auth_group')->where('id',input('id'))->update($data);
      if($code){
        $this->success('修改成功','lst');
      }else{
        $this->error('修改失败');
      }
      return;
    }
    $AuthRule = new AuthRuleModel();
    $AuthRuleModel = $AuthRule->AuthRuleTree();
    
    $AuthGroup = db('Auth_group')->find(input('id'));
    $this->assign(array(
      'AuthGroup'=>$AuthGroup,
      'AuthRule'=>$AuthRuleModel
    ));
    return view();
  }

  /** 
   * 用户组删除
   */
  public function del(){
    $id = input('id');
    $res = db('Auth_group')->where('id',$id)->delete();
    if($res){
      $data = [
        'statu' =>200,
        'info'  =>'删除成功'
      ];
    }else{
      $data = [
        'statu' =>400,
        'info'  =>'删除失败'
      ];
    }
    return $data;
  }

}
?>