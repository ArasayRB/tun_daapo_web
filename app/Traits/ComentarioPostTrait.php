<?php
namespace App\Traits;
use App\Models\ComentarioPost;
use Illuminate\Support\Facades\Validator;
use App\Traits\VisitorAccessTrait;
use App\Traits\CalificacionPostTrait;
use App\Traits\ConfigComentarioPostTrait;
use App\Traits\MessageTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

trait ComentarioPostTrait {
use CalificacionPostTrait, MessageTrait, VisitorAccessTrait, ConfigComentarioPostTrait;

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'email' => ['required', 'string', 'email', 'max:255'],
          'name' => ['required', 'string'],
          'message' => ['required'],
          'valuation' => ['required'],
      ]);
  }

  protected function validatorReply(array $data)
  {
      return Validator::make($data, [
          'email' => ['required', 'string', 'email', 'max:255'],
          'name' => ['required', 'string'],
          'message' => ['required'],
      ]);
  }

  public function makeComment(Request $request){
      $ip=$request->ip();
      $is_there=$this->isIp($ip);
      if($is_there->accept_privacy_pol==false){
         $this->updIpDataPol(1,$is_there->ip_visitor);
      }
        $this->validator($request->all())->validate();
        $valuation=request('valuation');
        $id_calific=$this->calificationByVal($valuation);
        $config=$this->getConfigComment();
        $comment=new ComentarioPost;
        $comment->email=request('email');
        $comment->fullName=request('name');
        $comment->comment=request('message');
        $comment->post_id=request('post_id');
        $comment->config_id=$config->id;
        $comment->calification_id=$id_calific[0]->id;
        $comment->save();
        $this->commentNotification($comment);
        $this->commentTunDaapoSend($comment,request('company_email'));
        $this->commentTunDaapoSend($comment,request('poster_email'));
        return $comment;
  }

  public function replyComment(Request $request){
    $new_reply=[];
    $ip=$request->ip();
    $is_there=$this->isIp($ip);
    if($is_there->accept_privacy_pol==false){
       $this->updIpDataPol(1,$is_there->ip_visitor);
    }
      $this->validatorReply($request->all())->validate();
  $config=$this->getConfigComment();
  $comment_reply_id=request('comment_reply');
    $comment_reply=ComentarioPost::find($comment_reply_id);
    if($comment_reply->answer_to===null){
    if($comment_reply->count_answer<$config->max_answers){

      $comment_reply->count_answer+=1;
      $comment_reply->update();
      $new_reply=new ComentarioPost;
      $new_reply->email=request('email');
      $new_reply->fullName=request('name');
      $new_reply->comment=request('message');
      $new_reply->count_nivels=$comment_reply->count_nivels+1;
      $new_reply->count_answer=$comment_reply->count_nivels+1;
      $new_reply->post_id=request('post_id');
      $new_reply->config_id=$config->id;
      $new_reply->answer_to=$comment_reply_id;
      $new_reply->save();
      $this->commentNotification($new_reply);
      $this->commentTunDaapoSend($new_reply,request('company_email'));
      $this->commentTunDaapoSend($new_reply,request('poster_email'));
    }
    }
    else
     if(($comment_reply->count_nivels<$config->max_nivel) && ($comment_reply->count_answer>0 && $comment_reply->count_answer<($config->max_answers-1))){


         $comment_reply->count_answer+=1;
         $comment_reply->update();
         $new_reply=new ComentarioPost;
         $new_reply->email=request('email');
         $new_reply->fullName=request('name');
         $new_reply->comment=request('message');
         $new_reply->count_nivels=$comment_reply->count_nivels+1;
         $new_reply->count_answer=$comment_reply->count_answer+1;
         $new_reply->post_id=request('post_id');
         $new_reply->config_id=$config->id;
         $new_reply->answer_to=$comment_reply_id;
         $new_reply->save();
         $this->commentNotification($new_reply);
         $this->commentTunDaapoSend($new_reply,request('company_email'));
         $this->commentTunDaapoSend($new_reply,request('poster_email'));
     }
     else{
       $new_reply='over';
     }
   return $new_reply;
  }

  public function getComentsByPost(int $post){
    $comments=ComentarioPost::where('post_id',$post)
                            ->where('answer_to',null)
                            ->where('publish',1)
                            ->get();
    for($i=0;$i<count($comments);$i++) {
      $evaluation=$this->calificationById($comments[$i]->calification_id);
      $comments[$i]->evaluation=$evaluation->calification;
      $is_answer=ComentarioPost::where('post_id',$post)
                              ->where('publish',1)
                              ->where('answer_to',$comments[$i]->id)
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
    }
    return $comments;
  }

  public function getComentsReplyByPost(int $post,int $comment){
    if(auth()){
    $comments=ComentarioPost::where('post_id',$post)
                            ->where('answer_to',$comment)
                            ->get();
    for($i=0;$i<count($comments);$i++) {
      $is_answer=ComentarioPost::where('post_id',$post)
                              ->where('answer_to',$comments[$i]->id)
                              ->get();
      if(count($is_answer)>0){
        $comments[$i]->has_answer='yes';
      }
      else{
        $comments[$i]->has_answer='no';
      }
      $comments[$i]->show='false';
    }
  }
  else{
    $comments=ComentarioPost::where('post_id',$post)
                            ->where('answer_to',$comment)
                            ->where('publish',1)
                            ->get();
    for($i=0;$i<count($comments);$i++) {
      $is_answer=ComentarioPost::where('post_id',$post)
                              ->where('answer_to',$comments[$i]->id)
                              ->where('publish',1)
                              ->get();
      if(count($is_answer)>0){
        $comments[$i]->has_answer='yes';
      }
      else{
        $comments[$i]->has_answer='no';
      }
      $comments[$i]->show='false';
    }
  }
    return $comments;
  }

}
