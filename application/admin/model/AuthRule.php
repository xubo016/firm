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

  /**
   * 无限极删除
   */
  public function getchilrenid($AuthRuleid){
    $AuthRuleres = $this->select();
    return $this->_getchilrenid($AuthRuleres,$AuthRuleid);
  }

  //删除的回调函数
  public function _getchilrenid($AuthRuleres,$pid){
    static $arr = array();
    foreach($AuthRuleres as $k=>$v){
      if($v['pid']==$pid){
        $arr[]=$v['id'];
        $this->_getchilrenid($AuthRuleres,$v['id']);
      }
    }
    return $arr;
  }

}
?>