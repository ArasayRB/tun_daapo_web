<?php

namespace App\Traits;
use App\Models\ContentType;

trait ContentTypeTrait {
  public function findContentId($name){
    $id_content=ContentType::where('name',$name)
                            ->get();
    return $id_content[0]['id'];
  }

  public function getContentTypeByName($name){
    $content_type=ContentType::where('name',$name)
                             ->get();
                             return $content_type;
  }
}
