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

  /**
   * 栏目查询
   */
  public function catetree(){
    $cate = $this->select();
    return $this->sort($cate);
  }
  //回调函数
  public function sort($data,$pid=0,$level=0){
    static $arr = array();
    foreach($data as $k => $v){
      if($v['pid']==$pid){
        $v['level']=$level;
        $arr[] = $v;
        $this->sort($data,$v['id'],$level+1);
      }
    }
    return $arr;
  }

  /**
   * 无限极删除
   */
  public function getchilrenid($cateid){
    $cateres = $this->select();
    return $this->_getchilrenid($cateres,$cateid);
  }

  //删除的回调函数
  public function _getchilrenid($cateres,$pid){
    static $arr = array();
    foreach($cateres as $k=>$v){
      if($v['pid']==$pid){
        $arr[]=$v['id'];
        $this->_getchilrenid($cateres,$v['id']);
      }
    }
    return $arr;
  }
  
}
?>