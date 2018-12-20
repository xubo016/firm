<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\Admin as AdminModel;
use app\admin\validate\Admin as AdminValidate;
use app\admin\controller\Auth;
class Admin extends Common
{
  /** 
   * 管理员添加
   */
  public function add()
  {
    //判断是否是post来的数据
    if(request()->isPost()){
      $data = input('post.');
      $val = new AdminValidate();
      if(!$val->check($data)){
        $this->error($val->getError());
        exit;
      }
      //实列化控制器方法
      $admin = new AdminModel();
      //将接收的数组传递到模型
      $res = $admin->addadmin($data);
      //判断添加是否成功
      if($res){
        $this->success('添加成功');
      }else{
        $this->error('添加失败');
      }
      return;
    }
    $authGroup = db('auth_group')->field('id,title')->select();
    $this->assign('authGroup',$authGroup);
    return $this->fetch();
  }

  /**
   * 管理员列表
   */
  public function lst()
  {
    $auth = new Auth();
    $admin = new AdminModel();
    $res = $admin->getadmin();
    foreach($res as $k => $v){
      $groupTitle = $auth->getGroups($v['id']);
      $v['groupTitle']= $groupTitle[0]['title'];
    }
    //分配数据到页面
    $this->assign('res',$res);
    return $this->fetch();
  }

  /**
   * 单条删除
   */
  public function ajax_del(){
    //接收数据 /d强制转换整型防止sql注入
    $id = input("post.id/d");
    //执行删除
    $code = AdminModel::destroy($id);
    //判断是否成功
    if($code){
      $data=[
        "statu"=>200,
        "info"=>"删除成功"
      ];
    }else{
      $data=[
        "statu"=>400,
        "info"=>"删除失败"
      ];
    }
    //返回数组
    return $data;
  }

  /**
   * 管理员修改
   */
  public function edit($id)
  {
    //查询管理员信息
    $code = db('admin')->find($id);
    //修改信息
    if(request()->isPost()){
      $data = input('post.');
      $validate = \think\Loader::validate('Admin');
      if(!$validate->scene('edit')->check($data)){
        $this->error($validate->getError());
      }
      $admin = new AdminModel();
      $res = $admin->allowField(true)->save($data,['id'=>input('id')]);
      if($res !== false){
        db('auth_group_access')->where('uid',$data['id'])->update(['group_id'=>$data['group_id']]);
        $this->success('修改成功','lst');
      }else{
        $this->error('修改失败');
      }
      return;
    }
    //接收管理员信息赋值到页面
    if(!$code){
      $this->error("该管理员不存在",'lst');
    }
    $addAccess = db('auth_group_access')->where('uid',$id)->field('group_id')->find();
    $authGroup = db('auth_group')->field('id,title')->select();
    $this->assign(array(
      'admin'=>$code,
      'authGroup'=>$authGroup,
      'addAccess'=>$addAccess['group_id']
    ));
    return view();
  }

  /**
   * 清空sessio退出登录
   */
  public function logout(){
    session(null);
    $this->success('退出系统成功','login/index');
  }
}