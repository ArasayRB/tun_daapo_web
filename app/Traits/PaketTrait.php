<?php

namespace App\Traits;
use App\Models\Paket;

trait PaketTrait {


  public function getPaketList(){
    $pakets=Paket::with('services')
                 ->with('functions')
                 ->get();
$content_type='Paket';
$packets_array_lang=[];
foreach ($pakets as $packet) {
  $paket_lang=$this->getTranslatedPaketBySigLang(app()->getLocale(),$packet->id,$content_type);
  $functions_lang=[];
  $content_func='Function';
for($i=0;$i<count($paket_lang->functions);$i++) {
  $paket_lang->functions[$i]=$this->getTranslatedFunctIncludedBySigLang(app()->getLocale(),$paket_lang->functions[$i]->id,$content_func);

}
$packets_array_lang[]=$paket_lang;
}

return $packets_array_lang;
  }

  public function getTranslatedPaketBySigLang($lang,$packet_id,$content_type){
    $id_lang=$this->getLangIdBySigla($lang);
    $content_types=$this->getContentTypeByName($content_type);
    $packet_translated=$this->getTranslatedTransItem($id_lang,$packet_id,$content_types[0]->id);
    $packet=$this->getPaket($packet_id);
    $keys_array=array_keys($packet_translated);
    if(count($packet_translated)!=0){
      foreach($keys_array as $key){
        $packet[$key]=$packet_translated[$key]['content_trans'];
      }
      return $packet;
    }
    else{
      return $packet;
    }

  }

  public function getTranslatedFunctIncludedBySigLang($lang,$function_id,$content_type){
    $id_lang=$this->getLangIdBySigla($lang);
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

  public function getPaketByName($name){
    $paket=Paket::where('name',$name)
                ->get();
    return $paket;
  }

  public function getPaket($paket){
    $pakets=Paket::with('services')
                 ->with('functions')
                 ->where('id',$paket)
                 ->first();
    return $pakets;
  }

  public function getTranslatedPackByLang(string $locale,$lang,$packet_id,$content_type){
    $id_lang=$this->getLangIdByName($lang);
    $content_types=$this->getContentTypeByName($content_type);
    $packet_translated=$this->getTranslatedTransItem($id_lang,$packet_id,$content_types[0]->id);
    $packet=$this->getPaket($packet_id);
    $packet->name=$packet_translated['name']['content_trans'];
    $packet->name_button=$packet_translated['name_button']['content_trans'];
    $packet->description=$packet_translated['description']['content_trans'];
    return $packet;
  }
}
