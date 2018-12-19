<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\AuthRule as AuthRuleModel;
class AuthRule extends Common
{

  /** 
   * 权限添加
   */
  public function add(){
    if(request()->isPost()){
      $data = input('post.');
      $level = db('auth_rule')->where('id',$data['pid'])->field('level')->find();
      if($level){
        $data['level'] = $level['level']+1;
      }else{
        $data['level'] = 0;
      }
      $add = db('auth_rule')->insert($data);
      if($add){
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
   * 权限列表
   */
  public function lst(){
    $AuthRule = new AuthRuleModel();
    $AuthRuleModel = $AuthRule->AuthRuleTree();
    $this->assign('AuthRule',$AuthRuleModel);
    return view();
  }

  /** 
   * 权限修改
   */
  public function edit(){
    $AuthRule = new AuthRuleModel();
    if(request()->isPost()){
      $data = input('post.');
      $level = db('auth_rule')->where('id',$data['pid'])->field('level')->find();
      if($level){
        $data['level'] = $level['level']+1;
      }else{
        $data['level'] = 0;
      }
      $save = $AuthRule->save($data,array('id'=>$data['id']));
      if($save){
        $this->success('修改成功');
      }else{
        $this->error('修改失败');
      }
    }
    $id = input('id');
    $AuthRuleModel = $AuthRule->AuthRuleTree();
    $Auth = $AuthRule->find($id);
    $this->assign(array(
      'Auth'=>$Auth,
      'AuthRule'=>$AuthRuleModel
    ));
    return view();
  }

  /** 
   * 权限删除
   */
  public function del(){
    $AuthRule = new AuthRuleModel;
    $AuthRuleid = input('id'); //要删除的当前栏目id
    $deleteid = $AuthRule->getchilrenid($AuthRuleid);
    $deleteid[] = $AuthRuleid;
    $del = $AuthRule->destroy($deleteid);
    if($del){
      $this->success('删除成功');
    }else{
      $this->error('删除失败');
    }
  }

}


?>