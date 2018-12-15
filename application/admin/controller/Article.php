<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\Cate as CateModel;
use app\admin\model\Article as ArticleModel;
class Article extends Common
{
  
  /**
   * 文章添加
   */
  public function add(){
    if(request()->isPost()){
      $data = input('post.');
      $validate = \think\Loader::validate('Article');
      if(!$validate->scene('add')->check($data)){
        $this->error($validate->getError());
      }
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

  /**
   * 文章列表
   */
  public function lst(){
    $art = db('article')->field('a.*,b.catename')->alias('a')->join('qy_cate b','a.cateid=b.id')->paginate(10);
    $this->assign("article",$art);
    return view();
  }

  /**
   * 文章修改
   */
  public function edit(){
    $tree = new CateModel;
    $value = $tree->catetree();
    $article = db('article')->find(input('id'));
    $this->assign(array(
      'article'=>$article,
      'value'=>$value
    ));
    if(request()->isPost()){
      $data = input('post.');
      $validate = \think\Loader::validate('Article');
      if(!$validate->scene('edit')->check($data)){
        $this->error($validate->getError());
      }
      $art = new ArticleModel;
      $res = $art->update($data);
      if($res){
        $this->success('修改成功','lst');
      }else{
        $this->error('修改失败');
      }
    }
    return view();
  }

  /**
   * 文章删除
   */
  public function del(){
    $arts = new ArticleModel;
    if($arts::destroy(input('id'))){
      $this->success('删除成功','lst');
    }else{
      $this->error('删除失败','lst');
    }
  }

}
?>