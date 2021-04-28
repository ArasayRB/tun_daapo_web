<?php

namespace App\Http\Controllers;

use App\Models\ComentarioPost;
use App\Traits\ComentarioPostTrait;
use App\Traits\PostTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ComentarioPostController extends Controller
{
  use ComentarioPostTrait, PostTrait;

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getAllComments(Request $request){
    $filter=$request->searcher;
    $comments=ComentarioPost::filterByAttribute($filter)
                    ->get();
    $comments_searched=[];
    foreach($comments as $comment){
      $findEmail=stristr($comment->email,$filter);
      $findFullName=stristr($comment->fullName,$filter);
      if(!empty($findFullName)){
        $prop='fullName';
        $comment->finded==$findFullName;
        $small_word=substr($findFullName,0,strlen($filter));
        $comment->substr=$small_word;
        $comment->name=$comment->fullName;
        $comment->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$comment->fullName);
        $comments_searched[]=$comment;
      }
      if(!empty($findEmail)){

          $prop='email';
          $comment->finded==$findEmail;
          $small_word=substr($findEmail,0,strlen($filter));
          $comment->substr=$small_word;
          $comment->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$comment->email);
          $comments_searched[]=$comment;
      }
    }
    return $comments_searched;
  }

  public function getComments(){
    $comments=ComentarioPost::all();
    for($i=0;$i<count($comments);$i++) {
      $is_answer=ComentarioPost::where('answer_to',$comments[$i]->id)
                              ->get();
      if(count($is_answer)>0){
        $comments[$i]->has_answer='yes';
      }
      else{
        $comments[$i]->has_answer='no';
      }
      $comments[$i]->show='false';
      $data=Carbon::parse($comments[$i]->created_at)->format('Y-m-d H:m');
       $comments[$i]->time=$data;
       if($comments[$i]->publish===0){
         $comments[$i]->show_btn=false;
       }
       else{
         $comments[$i]->show_btn=true;
       }
       $post=$this->getPostById($comments[$i]->post_id);
       $comments[$i]->post=$post;
    }
    return $comments;
  }

  public function publicateComment(string $language,int $idComment,$state){
    $comment=ComentarioPost::find($idComment);
    $comment->publish=$state;
    $comment->update();
    if($comment->publish===0){
    $comment->show_btn=false;
  }
  else{

    $comment->show_btn=true;
  }
    return $comment;
  }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.comments.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request['email']=auth()->user()->email;
      $request['name']=auth()->user()->name;
      return $this->replyComment($request);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComentarioPost  $comentarioPost
     * @return \Illuminate\Http\Response
     */
    public function update(string $locale,Request $request, int $comentarioPost)
    {
        $comment=ComentarioPost::findOrFail($comentarioPost);
        $comment->comment=request('message');
        $comment->save();
        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComentarioPost  $comentarioPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $locale,int $comentarioPost)
    {
        $comment=ComentarioPost::findOrFail($comentarioPost);
        if($comment->answer_to!=null){
          $answer_to=ComentarioPost::findOrFail($comment->answer_to);
          $answer_to->count_answer-=1;
          $answer_to->update();
        }
        $comment->delete();
    }
}
