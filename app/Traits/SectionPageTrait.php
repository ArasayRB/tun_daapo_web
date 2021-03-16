<?php

namespace App\Traits;
use App\Models\SectionPage;

trait SectionPageTrait {

    public function getSectionItem(string $name){
      $sectionItem=SectionPage::where('title',$name)
                              ->get();
      return $sectionItem;
    }

    public function getSection($section){
      return SectionPage::find($section);
    }

    public function getTranslatedItemByLang($lang,$section_id,$content_type){
      $id_lang=$this->getLangIdByName($lang);
      $content_types=$this->getContentTypeByName($content_type);
      $section_translated=$this->getTranslatedTransItem($id_lang,$section_id,$content_types[0]->id);
      $section=$this->getSection($section_id);
      $section->title=$section_translated['title']['content_trans'];
      $section->description=$section_translated['description']['content_trans'];
      return $section;
    }
}
