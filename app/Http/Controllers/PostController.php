<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\KeywordTrait;
use App\Traits\ImageTrait;
use App\Traits\CategoryPostTrait;
use App\Traits\ContentTypeTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;
use App\Traits\TaggingTagTrait;
use App\Traits\PostTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
  use KeywordTrait; use CategoryPostTrait; use TaggingTagTrait; use ImageTrait; use ContentTypeTrait; use TranslateTrait; use LanguageTrait;  use PostTrait;
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getAllPosts(Request $request){
    $filter=$request->searcher;
    $posts=Post::filterByAttribute($filter)
                    ->get();
    $posts_searched=[];
    foreach($posts as $post){
      $findText=stristr($post->title,$filter);
      if(!empty($findText)){
        $prop='title';
        $post->finded==$findText;
        $small_word=substr($findText,0,strlen($filter));
        $post->substr=$small_word;
        $post->name=$post->title;
        $post->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$post->title);
        $posts_searched[]=$post;
      }
    }
    return $posts_searched;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts=$this->existPost();
        return view('admin.posts.index',['posts'=>$posts]);
    }

    public function getPostAutentUser(){
      if(auth()->user()->roles->contains('slug','admin')||auth()->user()->roles->contains('slug','publisher-content')){
        $posts=Post::with('categoriaPosts')
                     ->with('keywords')
                     ->with('users')
                     ->orderBy('created_at','asc')
                     ->get();
      }
      else{
      $posts=Post::with('categoriaPosts')
                   ->with('keywords')
                   ->with('users')
                   ->where('user_id',auth()->user()->id)
                   ->orderBy('created_at','asc')
                   ->get();
                 }
      $id_lang=$this->getLangIdBySigla(app()->getLocale());
      for($i=0;$i<count($posts);$i++){
        $tags_lang=[];
        $keywords_lang=[];
        $tags=[];
        $keywords=[];
        $id_lang_post=$this->getLangIdBySigla($posts[$i]->default_lang);
        foreach ($posts[$i]->taggingtags as $tag) {
          if($tag->pivot->language_id===$id_lang){
            $tags_lang[]=$tag;
          }
          if($tag->pivot->language_id===$id_lang_post){
            $tags[]=$tag;
          }
        }
        for($n=0;$n<count($posts[$i]->keywords);$n++) {
          if($posts[$i]->keywords[$n]->language_id===$id_lang){
            $keywords_lang[]=$posts[$i]->keywords[$n];
          }
          if($posts[$i]->keywords[$n]->language_id===$id_lang_post){
            $keywords[]=$posts[$i]->keywords[$n];
          }
        }
        $posts[$i]->tags_lang=$tags_lang;
        $posts[$i]->tags_post=$tags;
        $posts[$i]->keywords_lang=$keywords_lang;
        $posts[$i]->keywords_post=$keywords;
        if($posts[$i]->publicate_state===0){
          $posts[$i]->show=false;
        }
        else{
          $posts[$i]->show=true;
        }
      }
                   return $posts;
    }

    public function previewPost(Request $request,$slug){
      return $this->show($request->ip(),$slug,'preview');
    }

    public function publicatePost($idPost,$state){
      $post=Post::find($idPost);
      $this->authorize('publicate',$post);
      $post->publicate_state=$state;
      $post->update();
      if($post->publicate_state===0){
      $post->show=false;
    }
    else{

      $post->show=true;
    }
      return $this->getPost($post->id);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories=$this->getCategories();

        return view('admin.posts.create',['categories'=>$categories]);
    }

    public function getCategories()
    {
      $post=Post::first();
      $categories=$this->allCategories();

        return $categories;
    }

    public function getTagsExisting()
    {
      $tags=$this->getTags();
      $tags_array=[];
      foreach ($tags as $tag) {
        $tags_array[]=array('key'=>'',
                            'value'=>$tag->name);
      }

        return $tags_array;
    }

    public function availableKeys()
    {
      $keywords=$this->getAllKeyword();
      $keywords_array=[];
      foreach ($keywords as $keyword) {
        $keywords_array[]=array('key'=>'',
                                'value'=>$keyword->name);
      }

        return $keywords_array;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $dataPost=request()->validate([
          'title'=> 'required|max:255',
          'default-lang'=> 'required',
          'image'=> 'required|image',
          'category'=> 'required',
          'checkEditSummary'=> 'required',
          'checkEditContent'=> 'required',
          'tags'=> 'required',
        ]);
        $newFileName=$this->manageImage(request('image'));

        $tags;
        $keywords;
        if(strpos(request('tags'), ',')){
          $tags = explode(",", request('tags'));
        }
        else{
          $tags=request('tags');
        }

        if(strpos(request('keywords'), ',')){
          $keywords = explode(",", request('keywords'));
        }
        else{
          $keywords=request('keywords');
        }
        $post= new Post();
        $post->title=request('title');
        $post->default_lang=request('default-lang');
        $post->content=request('checkEditContent');
        $post->publicate_state=false;
        $post->summary=request('checkEditSummary');
        $post->img_url=$newFileName;
        $post->user_id=auth()->user()->id;
        $post->category_id=request('category');
        $post->cant_access_read=0;
        $post->cant_likes=0;
        $post->cant_shares=0;
        $post->tags=request('tags');
        $post->slug=Str::slug($post->title, '-');
        $this->authorize('store',$post);
        $post->save();
        $post->qr_img_url='qrcode_'.$post->id.'_'.$post->slug.'.svg';
        $post->update();
        QrCode::format('svg')->color(33, 56, 175)->generate(url('/post-list/'.$post->id),public_path('storage/qrcodes/posts/qrcode_'.$post->id.'_'.$post->slug.'.svg'));
        $post->tag($tags);
        $lang_id=$this->getLangIdBySigla(request('default-lang'));
        /*
         Getting ids from tags post
        */
        $ids_tags=[];
        if(is_array($tags)){
        foreach ($tags as $tagg) {
          $tagged=$this->getTagByName($tagg);
          $ids_tags[]=$tagged[0]->id;
          $post->taggingtags()->attach($tagged[0]->id,array('language_id'=>$lang_id));
        }
      }
      else{
        $tagged=$this->getTagByName($tags);
        $ids_tags[]=$tagged[0]->id;
        $post->taggingtags()->attach($tagged[0]->id,array('language_id'=>$lang_id));
      }
        /*
         End Getting ids from tags post
        */
        if(is_array($keywords)){
          foreach($keywords as $keyword){
            $existKey=$this->getKeywordIf($keyword,$lang_id);

            $post->keywords()->attach($existKey->id);
          }
        }
        else{
          $existKey=$this->getKeywordIf($keywords,$lang_id);
          $post->keywords()->attach($existKey->id);
        }



        $postToAdd=$this->getPost($post->id);
        return $postToAdd;
    }

    public function addTranslatePost(Request $request){
      $dataPost=request()->validate([
        'title'=> 'required|max:255',
        'lang'=> 'required',
        'checkEditSummary'=> 'required',
        'checkEditContent'=> 'required',
      ]);

      $tags;
      $keywords;
      if(strpos(request('tags'), ',')){
        $tags = explode(",", request('tags'));
      }
      else{
        $tags=request('tags');
      }

      if(strpos(request('keywords'), ',')){
        $keywords = explode(",", request('keywords'));
      }
      else{
        $keywords=request('keywords');
      }

      $post=Post::find(request('post_id'));
      $post->tag($tags);
      /*
       Getting ids from tags post
      */
      $ids_tags=[];
      if(is_array($tags)){
      foreach ($tags as $tagg) {
        $tagged=$this->getTagByName($tagg);
        $ids_tags[]=$tagged[0]->id;
        $post->taggingtags()->attach($tagged[0]->id,array('language_id'=>request('lang')));
      }
    }
    else{
      $tagged=$this->getTagByName($tags);
      $ids_tags[]=$tagged[0]->id;
      $post->taggingtags()->attach($tagged[0]->id,array('language_id'=>request('lang')));
    }
      /*
       End Getting ids from tags post
      */

      if(is_array($keywords)){
        foreach($keywords as $keyword){
          $existKey=$this->getKeywordIf($keyword,request('lang'));

          $post->keywords()->attach($existKey->id);
        }
      }
      else{
        $existKey=$this->getKeywordIf($keywords,request('lang'));
        $post->keywords()->attach($existKey->id);
      }


      $this->authorize('storeTranslate',$post);
      $contentType='Post';
      $tipo_content=$this->findContentId($contentType);

      $lang=$this->findLanguageName(request('lang'));


      $data_trans=array(
        ['id_content_trans'=>$post->id,
        'content'=>$post['content'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'content',
        'content_trans'=>request('checkEditContent')],
        ['id_content_trans'=>$post->id,
        'content'=>$post['summary'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'summary',
        'content_trans'=>request('checkEditSummary')],
        ['id_content_trans'=>$post->id,
        'content'=>$post['title'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'title',
        'content_trans'=>request('title')],
        ['id_content_trans'=>$post->id,
        'content'=>$post['slug'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'slug',
        'content_trans'=>Str::slug(request('title'), '-')]
      );
      $this->storeTranslate($data_trans);

      $postToAdd=$this->getPost($post->id);
      return $postToAdd;
    }

    public function getTranslatedPostById($id){
      $array_translates_posts=$this->getPostTranslatesById($id);
      return $array_translates_posts;
    }

    public function getTranslatedLanguagePostById($id){
      $array_trans_lang_post=$this->getItemTranslatesLanguageById($id);
      return $array_trans_lang_post;
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post=Post::find($post->id);
        return $post;
        //return view('admin.posts.edit',['post'=>$post,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

      /*if(Gate::denies('admin')){
        abort('403');
      }*/
      $this->authorize('update',$post);

      $post= Post::findOrFail($post->id);
      $newFileName;
      $dataPost;
      if (request('img_url')!=""){
        $dataPost=request()->validate([
          'title'=> 'required|max:255',
          'default-lang'=> 'required',
          'img_url'=> 'required|image',
          'category_id'=> 'required',
          'summary'=> 'required',
          'content'=> 'required',
          'tags'=> 'required',
        ]);
        $newFileName=$this->manageImage(request('img_url'));

        $this->delImage($post->img_url);
          $post->img_url=$newFileName;
      }
      else{
        $dataPost=request()->validate([
          'title'=> 'required|max:255',
          'default-lang'=> 'required',
          'category_id'=> 'required',
          'summary'=> 'required',
          'content'=> 'required',
          'tags'=> 'required',
        ]);
      }
      $tags;
      $keywords;
      if(strpos(request('tags'), ',')){
        $tags = explode(",", request('tags'));
      }
      else{
        $tags=request('tags');
      }

      if(strpos(request('keywords'), ',')){
        $keywords = explode(",", request('keywords'));
      }
      else{
        $keywords=request('keywords');
      }

        if($post->title!=request('title')){
        $file_path = public_path("storage/qrcodes/posts/$post->qr_img_url");

       if(File::exists($file_path)) File::delete($file_path);
       $post->title=request('title');
       $post->slug=Str::slug($post->title, '-');
       QrCode::format('svg')->color(33, 56, 175)->generate(url('/post-list/'.$post->id),public_path('storage/qrcodes/posts/qrcode_'.$post->id.'_'.$post->slug.'.svg'));
       }

        $post->default_lang=request('default-lang');
        $post->content=request('content');
        $post->summary=request('summary');
        $post->category_id=request('category_id');
        $post->cant_access_read=0;
        $post->cant_likes=0;
        $post->cant_shares=0;
        $post->qr_img_url='qrcode_'.$post->id.'_'.$post->slug.'.svg';
        $id_lang_post=$this->getLangIdBySigla($post->default_lang);
        $tags_lang=[];
        $tags_id_langs=[];
        foreach ($post->taggingtags as $tagg) {
          if($tagg->pivot->language_id!=$id_lang_post){
            $tags_lang[]=$tagg->name;
            $tags_id_langs[]=$tagg;
          }
        }
        $tags_lang_text=implode(',',$tags_lang);
        $new_tags_text=request('tags').','.$tags_lang_text;
        $post->tags=$new_tags_text;
        $tags_new=explode(",", $new_tags_text);
        $post->update();
        $post->retag($tags_new);
        $post->taggingtags()->detach();
  if(is_array($tags)){
        foreach ($tags as $tagg) {
          $tagged=$this->getTagByName($tagg);
          $ids_tags[]=$tagged[0]->id;
          $post->taggingtags()->attach($tagged[0]->id,array('language_id'=>$id_lang_post));
        }
      }
      else{
        $tagged=$this->getTagByName($tags);
        $ids_tags[]=$tagged[0]->id;
        $post->taggingtags()->attach($tagged[0]->id,array('language_id'=>$id_lang_post));
    }
    foreach ($tags_id_langs as $til) {
      $tagged=$this->getTagByName($til->name);
      $ids_tags[]=$til->id;
      $post->taggingtags()->attach($til->pivot->tag_id,array('language_id'=>$til->pivot->language_id));
    }
      $keywords_lang=[];
      $keywords_id_lang=[];
      foreach ($post->keywords as $keys) {
        if($keys->language_id!=$id_lang_post){
          $keywords_lang[]=$keys->name;
          $keywords_id_lang[]=$keys;
        }
      }
        $post->keywords()->detach();
        if(is_array($keywords)){
          foreach($keywords as $keyword){
            $existKey=$this->getKeywordIf($keyword,$id_lang_post);

            $post->keywords()->attach($existKey->id);
          }
        }
        else{
          $existKey=$this->getKeywordIf($keywords,$id_lang_post);
          $post->keywords()->attach($existKey->id);
        }

        foreach ($keywords_id_lang as $kil) {
          $post->keywords()->attach($kil->id);
        }

        $postToUpd=$this->getPost($post->id);
        return $postToUpd;
    }

    public function updateTranslatedPostByLang($post_id,$lang_name, Request $request){
    $dataPost=request()->validate([
        'title'=> 'required|max:255',
        'content'=> 'required',
        'summary'=> 'required',
      ]);
      $tags;
      $keywords;
      if(strpos(request('tags'), ',')){
        $tags = explode(",", request('tags'));
      }
      else{
        $tags=request('tags');
      }

      if(strpos(request('keywords'), ',')){
        $keywords = explode(",", request('keywords'));
      }
      else{
        $keywords=request('keywords');
      }


      $post_find=Post::findOrFail($post_id);
      $post=$this->getPost($post_id);
        $contentType='Post';
      $tipo_content=$this->findContentId($contentType);

      $lang=$this->getLangIdByName($lang_name);

      /*Start keywords and tags process*/
      $tags_lang=[];
      $tags_id_langs=[];
      foreach ($post->taggingtags as $tagg) {
        if($tagg->pivot->language_id!=$lang){
          $tags_lang[]=$tagg->name;
          $tags_id_langs[]=$tagg;
        }
      }
      $tags_lang_text=implode(',',$tags_lang);
      $new_tags_text=request('tags').','.$tags_lang_text;
      $post_find->tags=$new_tags_text;
      $tags_new=explode(",", $new_tags_text);
      $post_find->update();
      $post_find->retag($tags_new);
      $post->taggingtags()->detach();
if(is_array($tags)){
      foreach ($tags as $tagg) {
        $tagged=$this->getTagByName($tagg);
        $ids_tags[]=$tagged[0]->id;
        $post->taggingtags()->attach($tagged[0]->id,array('language_id'=>$lang));
      }
    }
    else{
      $tagged=$this->getTagByName($tags);
      $ids_tags[]=$tagged[0]->id;
      $post->taggingtags()->attach($tagged[0]->id,array('language_id'=>$lang));
  }
  foreach ($tags_id_langs as $til) {
    $tagged=$this->getTagByName($til->name);
    $ids_tags[]=$til->id;
    $post->taggingtags()->attach($til->pivot->tag_id,array('language_id'=>$til->pivot->language_id));
  }
    $keywords_lang=[];
    $keywords_id_lang=[];
    foreach ($post->keywords as $keys) {
      if($keys->language_id!=$lang){
        $keywords_lang[]=$keys->name;
        $keywords_id_lang[]=$keys;
      }
    }
      $post->keywords()->detach();
      if(is_array($keywords)){
        foreach($keywords as $keyword){
          $existKey=$this->getKeywordIf($keyword,$lang);

          $post->keywords()->attach($existKey->id);
        }
      }
      else{
        $existKey=$this->getKeywordIf($keywords,$lang);
        $post->keywords()->attach($existKey->id);
      }

      foreach ($keywords_id_lang as $kil) {
        $post->keywords()->attach($kil->id);
      }
      /*End Start keywords y tags process*/


      $data_trans=array(
        ['id_content_trans'=>$post_id,
        'content'=>request('content'),
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'content',
        'content_trans'=>request('content')],
        ['id_content_trans'=>$post_id,
        'content'=>request('summary'),
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'summary',
        'content_trans'=>request('summary')],
        ['id_content_trans'=>$post_id,
        'content'=>request('title'),
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'title',
        'content_trans'=>request('title')],
        ['id_content_trans'=>$post->id,
        'content'=>$post['slug'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'slug',
        'content_trans'=>Str::slug(request('title'), '-')]
      );
      $result=$this->updateTranslate($data_trans);

      $postToAdd=$this->getPost($post_id);
      return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function destroy(Post $post)
    {

      $this->authorize('delete',$post);
        $post=Post::find($post->id);
        $this->delImage($post->img_url);
          $contentType='Post';
          $tipo_content=$this->findContentId($contentType);
          $this->deleteTranslatedItemsByItem($post->id,$tipo_content);
        $post->delete();
        $post->untag();
        $post->keywords()->detach();
        $file_path = public_path("storage/qrcodes/posts/$post->qr_img_url");

       if(File::exists($file_path)) File::delete($file_path);
        return response()->json('Post deleted');
    }
}
