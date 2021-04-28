<?php

namespace App\Traits;
use App\Models\SectionPage;

trait SectionPageTrait {

    public function getSectionItem(string $lang,string $name){
      $sectionItem=SectionPage::where('title',$name)
                              ->get();
      $content_type='Section';
      $section_lang=$this->getTranslatedSectionBySigLang(app()->getLocale(),$sectionItem[0]->id,$content_type);
      return $section_lang;
    }

    public function getTranslatedSectionBySigLang($lang,$section_id,$content_type){
      $id_lang=$this->getLangIdBySigla($lang);
      $content_types=$this->getContentTypeByName($content_type);
      $section_translated=$this->getTranslatedTransItem($id_lang,$section_id,$content_types[0]->id);
      $section=$this->getSection($section_id);
      $section_show=[];
      $keys_array=array_keys($section_translated);
      if(count($section_translated)!=0){
        foreach($keys_array as $key){
          $section[$key]=$section_translated[$key]['content_trans'];
        }
        $section_show[0]=$section;
        return $section_show;
      }
      else{
        $section_show[0]=$section;
        return $section_show;
      }

    }

    public function getSection($section){
      return SectionPage::find($section);
    }

    public function getTranslatedSectionByLang(string $locale,$lang,$section_id,$content_type){
      $id_lang=$this->getLangIdByName($lang);
      $content_types=$this->getContentTypeByName($content_type);
      $section_translated=$this->getTranslatedTransItem($id_lang,$section_id,$content_types[0]->id);
      $section=$this->getSection($section_id);
      $section->title=$section_translated['title']['content_trans'];
      $section->description=$section_translated['description']['content_trans'];
      return $section;
    }
}
