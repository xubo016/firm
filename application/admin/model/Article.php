<?php
namespace app\admin\model;
use think\Model;
class Article extends Model
{
  /** 
   * 自动写入时间戳
   */
  protected $autoWriteTimestamp = 'datetime';
  protected $updateTime = false;
  /**
   * 文件上传
   */
  protected static function init()
  {
    /**
     * 文章添加图片
     */
    Article::event('before_insert', function ($Article) {
        if($_FILES['pic']['tmp_name']){
          $file = request()->file('pic');
          $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
          if($info){
            $pic = DS . 'uploads' . '/' .$info->getSaveName();
            $Article['pic']=$pic;
          }
        }
    });

    /**
     * 文章修改图片
     */
    Article::event('before_update', function ($Article) {
      $arts = Article::find($Article->id);
      $thumbpath = $_SERVER['DOCUMENT_ROOT'].$arts['pic'];
      if(file_exists($thumbpath)){
        @unlink($thumbpath);
      }
      if($_FILES['pic']['tmp_name']){
        $file = request()->file('pic');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
          $pic = DS . 'uploads' . '/' .$info->getSaveName();
          $Article['pic']=$pic;
        }
      }
    });

    /**
     * 文章删除图片
     */
    Article::event('before_delete', function ($Article) {
      $arts = Article::find($Article->id);
      $thumbpath = $_SERVER['DOCUMENT_ROOT'].$arts['pic'];
      if(file_exists($thumbpath)){
        @unlink($thumbpath);
      }
    });
  }
  
}
?>