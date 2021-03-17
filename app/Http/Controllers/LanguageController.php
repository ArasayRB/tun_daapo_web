<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Traits\LanguageTrait;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
  use LanguageTrait;
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getAllLanguages(Request $request){
    $filter=$request->searcher;
    $languages=Language::filterByAttribute($filter)
                    ->get();
    $languages_searched=[];
    foreach($languages as $language){
      $findLanguage=stristr($language->language,$filter);
      $findText=stristr($language->sigla,$filter);
      if(!empty($findText)){
        $prop='sigla';
        $language->finded==$findText;
        $small_word=substr($findText,0,strlen($filter));
        $language->substr=$small_word;
        $language->name=$language->sigla;
        $language->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$language->sigla);
        $languages_searched[]=$language;
      }
      if(!empty($findLanguage)){

          $prop='language';
          $language->finded==$findLanguage;
          $small_word=substr($findLanguage,0,strlen($filter));
          $language->substr=$small_word;
          $language->name=$language->language;
          $language->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$language->language);
          $languages_searched[]=$language;
      }
    }
    return $languages_searched;
  }

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'language' => ['required', 'string', 'max:255'],
          'sigla' => ['required', 'string', 'max:255'],
      ]);
  }


  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('admin.configuration.language.index');
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
    $language=new Language();
    $language->language=request('language');
    $language->sigla=request('sigla');
    $language->save();
    return $language;
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Language  $language
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Language $language)
  {
    $this->validator($request->all())->validate();
    $language=Language::findOrFail($language->id);
    $language->language=request('language');
    $language->sigla=request('sigla');
    $language->update();
    return $language;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Language  $language
   * @return \Illuminate\Http\Response
   */
  public function destroy(Language $language)
  {
    $language=Language::findOrFail($language->id);
    $language->delete();
  }
}
