<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ContentTypeTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;

class HomeController extends Controller
{
  use ContentTypeTrait, TranslateTrait, LanguageTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function hasTranslate($idItem,$name_content){
      $content_types=$this->getContentTypeByName($name_content);
      $language_translated=$this->getItemTranslatesLanguageById($idItem,$content_types[0]->id);
      return $language_translated;
    }

    public function getNoTransLangItem(int $idItem,string $content){
      $languages=$this->getLanguagesList();
      $newListTranslate=[];
      $tipo_content=$this->findContentId($content);
      $languages_translated=$this->getItemTranslatesLanguageById($idItem,$tipo_content);
      if($languages_translated!='no-language-added'){
      foreach ($languages as $trans) {
        if(array_search($trans->language,$languages_translated)===false){
          $newListTranslate[]=$trans;
           }
         }
        return $newListTranslate;
       }
       return $languages;
    }
}
