<?php

namespace App\Traits;
use App\Models\Language;

trait LanguageTrait {
    public function findLanguageName($id) {
        // Fetch all the users from the 'users' table.
        $translate = Language::find($id);
        return $translate;
    }

    public function getLangIdByName($lang_name){
      $id_lang=Language::where('language',$lang_name)
                       ->get();
                       return $id_lang[0]->id;

    }

    public function switchLang($language)
    {
        // Almacenar el lenguaje en la session
        session()->put('locale', $language);
        return redirect()->back();
    }

    public function getLanguagesList()
    {
      $language_list=Language::all();
      return $language_list;
    }

    public function getLangIdBySigla($lang_sigla){
      $id_lang=Language::where('sigla',$lang_sigla)
                       ->get();
                       return $id_lang[0]->id;

    }


}
