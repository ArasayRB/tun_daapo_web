<?php

namespace App\Http\Controllers;

use App\Models\ConfigComentarioPost;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ConfigComentarioPostController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'max_nivel' => ['required'],
          'max_answers' => ['required'],
      ]);
  }

  public function getCommentsConfig(){
    $configs=ConfigComentarioPost::all();
    return $configs;
  }

  public function getAllCommentConfig(Request $request){
    $filter=$request->searcher;
    $conf_comments=ConfigComentarioPost::filterByAttribute($filter)
                    ->get();
    $conf_comments_searched=[];
    foreach($conf_comments as $conf_comment){
      $findNivel=stristr($conf_comment->max_nivel,$filter);
      $findAnswer=stristr($conf_comment->max_answers,$filter);
      if(!empty($findAnswer)){
        $prop='max_answers';
        $conf_comment->finded==$findAnswer;
        $small_word=substr($findAnswer,0,strlen($filter));
        $conf_comment->substr=$small_word;
        $conf_comment->name=$conf_comment->max_answers;
        $conf_comment->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$conf_comment->max_answers);
        $conf_comments_searched[]=$conf_comment;
      }
      if(!empty($findNivel)){

          $prop='max_nivel';
          $conf_comment->finded==$findNivel;
          $small_word=substr($findNivel,0,strlen($filter));
          $conf_comment->substr=$small_word;
          $conf_comment->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$conf_comment->max_nivel);
          $conf_comments_searched[]=$conf_comment;
      }
    }
    return $conf_comments_searched;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.conf-comments.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validator($request->all())->validate();
      $conf_comment=new ConfigComentarioPost();
      $conf_comment->max_nivel=request('max_nivel');
      $conf_comment->max_answers=request('max_answers');
      $conf_comment->save();
      return $conf_comment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConfigComentarioPost  $configComentarioPost
     * @return \Illuminate\Http\Response
     */
    public function update(string $locale,Request $request, int $configComentarioPost)
    {
      $conf_comment=ConfigComentarioPost::findOrFail($configComentarioPost);
      $conf_comment->max_nivel=request('max_nivel');
      $conf_comment->max_answers=request('max_answers');
      $conf_comment->save();
      return $conf_comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConfigComentarioPost  $configComentarioPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $locale,int $configComentarioPost)
    {
      $conf=ConfigComentarioPost::findOrFail($configComentarioPost);
      $conf->delete();
    }
}
