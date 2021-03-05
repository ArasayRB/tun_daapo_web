<?php

namespace App\Traits;
use App\Models\SectionPage;

trait SectionPageTrait {

    public function getSectionItem(string $name){
      $sectionItem=SectionPage::where('title',$name)
                              ->get();
      return $sectionItem;
    }
}
