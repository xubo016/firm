<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\Cate as CateModel;
use app\admin\model\Article as ArticleModel;
class Article extends Common
{
  
  public function add(){
    if(request()->isPost()){
      $data = input('post.');
      $article = new ArticleModel;
      if($article->save($data)){
        $this->success("添加文章成功");
      }else{
        $this->error("添加失败");
      }
      return;
    }
    $cate = new CateModel;
    $code = $cate->catetree();
    $this->assign("value",$code);
    return view();
  }

  public function lst(){
    return view();
  }

  public function edit(){
    return view();
  }
  
}
?>