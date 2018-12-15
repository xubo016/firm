<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use think\Db;
use app\admin\model\Admin as AdminModel;
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
      $validate = \think\Loader::validate('Admin');
      if(!$validate->scene('add')->check($data)){
        $this->error($validate->getError());
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
    return $this->fetch();
  }

  /**
   * 管理员列表
   */
  public function lst()
  {
    $admin = new AdminModel();
    $res = $admin->getadmin();
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
    $code = Db::execute("delete from qy_admin where id = $id");
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
      if(!$data['user']){
        $this->error('管理员用户名不能为空');
      }
      if(!$data['password']){
        $data['password'] = $code['password'];
      }else{
        $data['password']=md5($data['password']);
      }
      $res = db('admin')->update($data);
      if($res !== false){
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
    $this->assign('admin',$code);
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