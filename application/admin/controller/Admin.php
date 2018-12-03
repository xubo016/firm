<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\Admin as AdminModel;
class Admin extends Controller
{
    public function add()
    {
      //判断是否是post来的数据
      if(request()->isPost()){
        //实列化控制器方法
        $admin = new AdminModel();
        //将接收的数组传递到模型
        $res = $admin->addadmin(input('post.'));
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
    public function lst()
    {
      $admin = new AdminModel();
      $res = $admin->getadmin();
      //分配数据到页面
      $this->assign('res',$res);
      return $this->fetch();
    }
    //单条删除
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
}