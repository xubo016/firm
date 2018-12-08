<?php
namespace app\admin\model;
use think\Model;
class Cate extends Model
{
  /**
   * 栏目添加
   */
  public function addcate($data){
    if(empty($data) || !is_array($data)){
      return false;
    }
    $res = $this->save($data);
    if($res){
      return true;
    }else{
      return false;
    }
  }
}




?>