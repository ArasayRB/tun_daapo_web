<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\SectionPageTrait;
use App\Traits\ServiceTrait;
use App\Traits\PortfolioTrait;
use App\Traits\PostTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;

class WelcomeController extends Controller
{
  use SectionPageTrait, ServiceTrait, PortfolioTrait, PostTrait, TranslateTrait, LanguageTrait;

  public function welcome()
  {
    $posts=$this->existPost();
      return view('welcome_tun_daapo',['posts'=>$posts]);
  }

  public function showPost($slug){
    return $this->show($slug,'real');
  }

  public function sharePostMedia($id,$media){
    return $this->sharePostMediaSocial($id,$media);
  }

  public function addLove($id){
    return $this->addLovePost($id);
  }

  public function getPostsList(){
    $posts_more_liked=$this->getPostsMoreLikes(3);
    for ($i=0;$i<count($posts_more_liked);$i++) {
      if($posts_more_liked[$i]->default_lang!=app()->getLocale()){
      $post_liked=$this->getTranslatedPostBySigLang(app()->getLocale(),$posts_more_liked[$i]->id);
      $posts_more_liked[$i]->title=$post_liked->title;
      $posts_more_liked[$i]->content=$post_liked->content;
      $posts_more_liked[$i]->summary=$post_liked->summary;

    }
    }
    $posts_more_read=$this->getPostsMoreRead(3);
    for ($i=0;$i<count($posts_more_read);$i++) {
      if($posts_more_read[$i]->default_lang!=app()->getLocale()){
        $post_read=$this->getTranslatedPostBySigLang(app()->getLocale(),$posts_more_read[$i]->id);
      $posts_more_read[$i]->title=$post_read->title;
      $posts_more_read[$i]->content=$post_read->content;
      $posts_more_read[$i]->summary= $post_read->summary;
    }
    }
    $latest_posts=$this->getLatestPosts(3);
    for ($i=0;$i<count($latest_posts);$i++) {
      if($latest_posts[$i]->default_lang!=app()->getLocale()){
        $latest=$this->getTranslatedPostBySigLang(app()->getLocale(),$latest_posts[$i]->id);
      $latest_posts[$i]->title=$latest->title;
      $latest_posts[$i]->content=$latest->content;
      $latest_posts[$i]->summary=$latest->summary;
    }
    }
    $posts=$this->getPosts();
    for ($i=0;$i<count($posts);$i++) {
      if($posts[$i]->default_lang!=app()->getLocale()){
        $post=$this->getTranslatedPostBySigLang(app()->getLocale(),$posts[$i]->id);
      $posts[$i]->title=$post->title;
      $posts[$i]->content=$post->content;
      $posts[$i]->summary=$post->summary;
     }
    }
    return ['posts'=>$posts,'posts_more_liked'=>$posts_more_liked,'posts_more_read'=>$posts_more_read,'latest_posts'=>$latest_posts];
  }
}
