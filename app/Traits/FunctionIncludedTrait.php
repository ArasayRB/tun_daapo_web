<?php

namespace App\Traits;
use App\Models\FunctionIncluded;

trait FunctionIncludedTrait {
    public function store($funct) {
        // Fetch all the users from the 'users' table.
        $functs = new FunctionIncluded();
        $functs->name=$funct;
        $functs->save();
        return $functs;
    }

    public function getFunctionIncludedIf($funct){
      $functs = FunctionIncluded::firstOrCreate(['name'=>$funct],['name'=>$funct]);

                   return $functs;
    }

    public function getFunction($function){
      return FunctionIncluded::find($function);
    }

    public function getTranslatedFunctionByLang($lang,$function_id,$content_type){
      $id_lang=$this->getLangIdByName($lang);
      $content_types=$this->getContentTypeByName($content_type);
      $function_translated=$this->getTranslatedTransItem($id_lang,$function_id,$content_types[0]->id);
      $function=$this->getFunction($function_id);
      $function->name=$function_translated['name']['content_trans'];
      $function->description=$function_translated['description']['content_trans'];
      return $function;
    }

    public function getAllFunctionIncluded(){
      $functs = FunctionIncluded::all();

                   return $functs;
    }

    public function getFunctionIncludedsInOffer(){
      $functs=FunctionIncluded::where('status',1)
                          ->get();
      return $functs;
    }
}
