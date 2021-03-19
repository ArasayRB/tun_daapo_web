<?php

namespace App\Traits;
use App\Models\Keyword;
use App\Traits\ContentTypeTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;

trait KeywordTrait {

use ContentTypeTrait,TranslateTrait,LanguageTrait;

    public function getKeywordIf($keyword,$lang_id){
      $keywords = Keyword::firstOrCreate(['name'=>$keyword],['name'=>$keyword,'language_id'=>$lang_id]);

                   return $keywords;
    }

    public function getAllKeyword(){
      $keywords = Keyword::all();

                   return $keywords;
    }

    /*public function addTranslateKeyw(Request $request){
      $data=request()->validate([
        'title'=> 'required|max:255',
        'lang'=> 'required',
        'description'=> 'required',
      ]);

      $section=SectionPage::find(request('section_id'));
      $contentType='Section';
      $tipo_content=$this->findContentId($contentType);

      $lang=$this->findLanguageName(request('lang'));


      $data_trans=array(
        ['id_content_trans'=>$section->id,
        'content'=>$section['title'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'title',
        'content_trans'=>request('title')],
        ['id_content_trans'=>$section->id,
        'content'=>$section['description'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'description',
        'content_trans'=>request('description')]
      );
      $this->storeTranslate($data_trans);
      return $section;
    }*/
}
