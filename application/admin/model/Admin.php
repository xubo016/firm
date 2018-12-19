<?php
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;
class Admin extends Model
{
  /** 
   * 软删除
   */
   use SoftDelete;
   protected static $deleteTime = 'delete_time';
   /** 
   * 自动写入时间戳
   */
  protected $autoWriteTimestamp = 'datetime';
  /** 
   * 自动完成
   */
  protected function setIpAttr()
  {
    return request()->ip();
  }
  protected function setPasswordAttr($value)
  {
    return md5($value);
  }
  protected function setRepasswordAttr($value)
  {
    return md5($value);
  }
  /** 
   * 添加数据
   */
  public function addadmin($data){
    //判断传递的值不为空并且是数组
    if(empty($data) || !is_array($data)){
      return false;
    }
    //执行添加  
    if($this->allowField(true)->save($data)){
      $addAccess['uid'] = $this->id;
      $addAccess['group_id'] = $data['group_id'];
      db('auth_group_access')->insert($addAccess);
      return true;
    }else{
      return false;
    }
  }

  /**
   * 分页查询数据
   */
  public function getadmin(){
    return $this::paginate(10);
  }

  /**
   * 登录
   */
  public function login($data){
    $admin = Admin::get(['user'=>$data['user']]);
    if($admin){
      if($admin['password']==md5($data['password'])){
        session('id',$admin['id']);
        session('user',$admin['user']);
        return 2; //登录密码正确 
      }else{
        return 3; //登录密码错误
      }
    }else{
      return 1; //用户不存在
    }
  }
}
?>