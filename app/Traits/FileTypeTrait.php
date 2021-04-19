<?php

namespace App\Traits;
use App\Models\FileType;

trait FileTypeTrait {
  public function findFileId($name){
    $id_content=FileType::where('name',$name)
                            ->get();
    return $id_content[0]['id'];
  }

  public function getFileTypeByName($name){
    $content_type=FileType::where('name',$name)
                             ->get();
                             return $content_type;
  }
}
