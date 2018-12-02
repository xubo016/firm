<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model
{
  //添加数据
  public function addadmin($data){
    //判断传递的值不为空并且是数组
    if(empty($data) || !is_array($data)){
      return false;
    }
    //md5()加密密码
    if($data['password']){
      $data['password'] = md5($data['password']); 
    }
    //执行添加
    $res = $this->save($data);
    //判断是否添加成功
    if($res){
      return true;
    }else{
      return false;
    }
  }
  //查询数据
  public function getadmin(){
    return $this::select();
  }

}
?>