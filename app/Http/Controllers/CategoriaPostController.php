<?php

namespace App\Http\Controllers;

use App\Models\CategoriaPost;
use Illuminate\Support\Facades\Validator;
use App\Traits\CategoryPostTrait;
use Illuminate\Http\Request;

class CategoriaPostController extends Controller
{
  use CategoryPostTrait;

     public function __construct()
     {
         $this->middleware('auth');
     }

     protected function validator(array $data)
     {
         return Validator::make($data, [
             'category_post' => ['required', 'string', 'max:255'],
             'description' => ['required', 'string'],
         ]);
     }

     public function getAllCategories(Request $request){
       $filter=$request->searcher;
       $categories=CategoriaPost::filterByAttribute($filter)
                       ->get();
       $categories_searched=[];
       foreach($categories as $category){
         $findText=stristr($category->category_post,$filter);
         if(!empty($findText)){
           $prop='name';
           $category->finded==$findText;
           $small_word=substr($findText,0,strlen($filter));
           $category->substr=$small_word;
           $category->name=$category->category_post;
           $category->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$category->category_post);
           $categories_searched[]=$category;
         }
       }
       return $categories_searched;
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.category.index');
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
      $category=new CategoriaPost();
      $category->category_post=request('category_post');
      $category->description=request('description');
      $category->save();
      return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoriaPost  $categoriaPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $categoriaPost)
    {
      $category=CategoriaPost::findOrFail($categoriaPost);
      $category->category_post=request('category_post');
      $category->description=request('description');
      $category->save();
      return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoriaPost  $categoriaPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $categoriaPost)
    {
      $category=CategoriaPost::findOrFail($categoriaPost);
      $category->delete();
    }
}
