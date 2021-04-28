<?php

namespace App\Traits;
use App\Models\FunctionIncluded;

trait FunctionIncludedTrait {

    public function getFunctionIncludedIf($funct){
      $functs = FunctionIncluded::firstOrCreate(['name'=>$funct],['name'=>$funct]);

                   return $functs;
    }

    public function getFunction($function){
      return FunctionIncluded::find($function);
    }

    public function getTranslatedFunctionByLang(string $locale,$lang,$function_id,$content_type){
      $id_lang=$this->getLangIdByName($lang);
      $content_types=$this->getContentTypeByName($content_type);
      $function_translated=$this->getTranslatedTransItem($id_lang,$function_id,$content_types[0]->id);
      $function=$this->getFunction($function_id);
      $keys_array=array_keys($function_translated);
      if(count($function_translated)!=0){
        foreach($keys_array as $key){
          $function[$key]=$function_translated[$key]['content_trans'];
        }
        return $function;
      }
      else{
        return $function;
      }
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
