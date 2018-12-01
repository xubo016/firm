<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model
{
  public function addadmin($data){
    //判断传递的值不为空并且是数组
    if(empty($data) || !is_array($data)){
      return false;
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
}
?>