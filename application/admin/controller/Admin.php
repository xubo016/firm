<?php
namespace app\admin\controller;
use think\Controller;
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
      return $this->fetch();
    }
}