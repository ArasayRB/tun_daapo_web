<?php

namespace App\Traits;
use App\Models\TaggingTag;

trait TaggingTagTrait {


  public function getTags(){
    return TaggingTag::all();
  }

  public function getTag($id){
    return TaggingTag::find($id);
  }

  public function getTagByName($name){
    return TaggingTag::where('name',$name)
                     ->get();
  }

  public function getTagBySlug($slug){
    return TaggingTag::where('slug',$slug)
                     ->get();
  }



}
