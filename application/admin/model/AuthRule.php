<?php
namespace app\admin\model;
use think\Model;
class AuthRule extends Model
{
  /**
   * 权限查询
   */
  public function AuthRuleTree(){
    $AuthRule = $this->select();
    return $this->sort($AuthRule);
  }
  //回调函数
  public function sort($data,$pid=0){
    static $arr = array();
    foreach($data as $k => $v){
      if($v['pid']==$pid){
        $arr[] = $v;
        $this->sort($data,$v['id']);
      }
    }
    return $arr;
  }
}
?>