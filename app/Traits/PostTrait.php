<?php

namespace App\Traits;
use App\Models\Post;
use App\Traits\ContentTypeTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;
use Illuminate\Support\Facades\Cache;

trait PostTrait {
  use ContentTypeTrait, TranslateTrait, LanguageTrait;
    public function getPosts() {
    $posts=Post::with('users')
                ->where('publicate_state',1)
                ->get();
    return $posts;
    }

    public function getPostsMoreRead($cant){
      $posts_more_read;
      if($cant===''){
      $posts_more_read=Post::with('users')
                           ->where('publicate_state',1)
                           ->orderBy('cant_access_read','DESC')
                           ->get();
                    }
      else {
        $posts_more_read=Post::with('users')
                             ->where('publicate_state',1)
                             ->take($cant)
                             ->orderBy('cant_access_read','DESC')
                             ->get();
      }
      return $posts_more_read;
    }

    public function getTranslatedPostByLang($lang,$post_id,$content_type){
      $id_lang=$this->getLangIdByName($lang);
      $content_types=$this->getContentTypeByName($content_type);
      $post_translated=$this->getTranslatedTransItem($id_lang,$post_id,$content_types[0]->id);
      $post=$this->getPost($post_id);
      $post->title=$post_translated['title']['content_trans'];
      $post->content=$post_translated['content']['content_trans'];
      $post->summary=$post_translated['summary']['content_trans'];
      $post->slug=$post_translated['slug']['content_trans'];
      $tags_lang=[];
      $keywords_lang=[];
      $tags=[];
      $keywords=[];
      $id_lang_post=$this->getLangIdBySigla($post->default_lang);
      foreach ($post->taggingtags as $tag) {
        if($tag->pivot->language_id===$id_lang){
          $tags_lang[]=$tag;
        }
        if($tag->pivot->language_id===$id_lang_post){
          $tags[]=$tag;
        }
      }
      for($i=0;$i<count($post->keywords);$i++) {
        if($post->keywords[$i]->language_id===$id_lang){
          $keywords_lang[]=$post->keywords[$i];
        }
        if($post->keywords[$i]->language_id===$id_lang_post){
          $keywords[]=$post->keywords[$i];
        }
      }
      $post->tags_lang=$tags_lang;
      $post->tags_post=$tags;
      $post->keywords_lang=$keywords_lang;
      $post->keywords_post=$keywords;
      return $post;
    }

    public function getPostById($id){
      return Post::with('categoriaPosts')
                   ->with('taggingtags')
                   ->with('keywords')
                   ->with('users')
                   ->where('id',$id)
                   ->first();
    }

    public function getPost($post){
      $posts=$this->getPostById($post);

       if($posts->publicate_state===0){
         $posts->show=false;
       }
       else{
         $posts->show=true;
        }

                   return $posts;
    }

    public function getTranslatedPostBySigLang($lang,$post_id){
      $id_lang=$this->getLangIdBySigla($lang);
      $content_type='Post';
      $content_types=$this->getContentTypeByName($content_type);
      $post_translated=$this->getTranslatedTransItem($id_lang,$post_id,$content_types[0]->id);
      $post=$this->getPost($post_id);
      if(count($post_translated)!=0){
        $post->title=$post_translated['title']['content_trans'];
        $post->content=$post_translated['content']['content_trans'];
        $post->summary=$post_translated['summary']['content_trans'];
        $post->slug=$post_translated['slug']['content_trans'];
        return $post;
      }
      else{
        return $post;
      }

    }

    public function getPostsMoreLikes($cant){
      $posts_more_liked;
      if($cant===''){
      $posts_more_liked=Post::with('users')
                           ->where('publicate_state',1)
                           ->orderBy('cant_likes','DESC')
                           ->get();
                    }
      else {
        $posts_more_liked=Post::with('users')
                             ->where('publicate_state',1)
                             ->take($cant)
                             ->orderBy('cant_likes','DESC')
                             ->get();
      }
      return $posts_more_liked;
    }

    public function getLatestPosts($cant){
      $latest_posts;
      if($cant===''){
      $latest_posts=Post::with('users')
                           ->where('publicate_state',1)
                           ->orderBy('created_at','DESC')
                           ->get();
                    }
      else {
        $latest_posts=Post::with('users')
                             ->where('publicate_state',1)
                             ->take($cant)
                             ->orderBy('created_at','DESC')
                             ->get();
      }
      return $latest_posts;
    }

    public function existPost(){
      $post=Post::all();
                  return count($post);

    }


    public function getPostBySlug($slug){
      return Post::with('categoriaPosts')
                   ->with('taggingtags')
                   ->with('keywords')
                   ->with('users')
                  ->where('slug',$slug)
                  ->first();
    }

    public function show($postSlug,$type){
      $post=$this->getPostBySlug($postSlug);
                  $id_post;
                  if($post===null||$post===''){
                    $id_content=$this->findContentId('Post');
                  $contet_translated=$this->getTransByIndContType('slug',$id_content);
                  foreach ($contet_translated as $cont) {
                    foreach ($cont->languages as $lang) {
                      if($lang->pivot->content_trans===$postSlug){
                        $id_post=$cont->id_content_trans;
                  }
                    }
                  }
              $post=$this->getPostById($id_post);
                  }
    if($type==="real"){

      if(Cache::has($post->id)==false){
         Cache::add($post->id,'contador',0.30);
         $post->cant_access_read++;
         $post->save();
      }

        if($post->default_lang!=app()->getLocale()){
          $post_lang=$this->getTranslatedPostBySigLang(app()->getLocale(),$post->id);
          $post->title=$post_lang->title;
          $post->content=$post_lang->content;
          $post->summary= $post_lang->summary;
          $post->slug= $post_lang->slug;
        }
        $id_lang=$this->getLangIdBySigla(app()->getLocale());
        $tags_lang=[];
        $keywords_lang=[];
        $tags=[];
        $keywords=[];
        $id_lang_post=$this->getLangIdBySigla($post->default_lang);
        foreach ($post->taggingtags as $tag) {
          if($tag->pivot->language_id===$id_lang){
            $tags_lang[]=$tag;
          }
          if($tag->pivot->language_id===$id_lang_post){
            $tags[]=$tag;
          }
        }
        for($i=0;$i<count($post->keywords);$i++) {
          if($post->keywords[$i]->language_id===$id_lang){
            $keywords_lang[]=$post->keywords[$i];
          }
          if($post->keywords[$i]->language_id===$id_lang_post){
            $keywords[]=$post->keywords[$i];
          }
        }
        $post->tags_lang=$tags_lang;
        $post->tags_post=$tags;
        $keywords_lang_array='';
        for ($i=0;$i<count($keywords_lang);$i++) {
          if($i==0){
            $keywords_lang_array=$keywords_lang[$i]->name;
          }
          else{
          $keywords_lang_array.=','.$keywords_lang[$i]->name;
        }
        }
        $post->keywords_lang_array=$keywords_lang_array;
        $post->keywords_post=$keywords;

      return view('/posts/show',['post'=>$post]);
    }


     return view('/posts/show',['post'=>$post,'preview'=>'vista previa']);
    }

    public function relationedPostByTags($id){
      $post=Post::with('users')
                ->find($id);
      $relationed_posts=[];
      $tags=$post->tags;
      $posts=$this->getPosts();
      foreach ($posts as $poste) {
        foreach ($poste->tags as $tagg) {
      foreach ($tags as $tag) {
        if(($tagg->id===$tag->id) && ($post->id!=$poste->id) && (in_array($poste,$relationed_posts)===false)){
          $relationed_posts[]=$poste;
        }
      }
      }
      }
                return ['tags'=>$tags,'relationed_posts'=>$relationed_posts];
    }

    public function addLovePost($idPost){
      $post=Post::with('users')
                  ->find($idPost);
        $post->cant_likes++;
        $post->save();
      return $post;
    }

    public function sharePostMediaSocial($idPost,$idMedia){
      $post=Post::with('users')
                  ->find($idPost);
        $post->cant_shares++;
        $post->save();
      return $post;
    }


}
