<?php

namespace App\Traits;
use App\Models\Paket;

trait PaketTrait {



  public function getPaketList(){
    $pakets=Paket::with('services')
                 ->with('functions')
                 ->get();
    return $pakets;
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

  public function getTranslatedPackByLang($lang,$packet_id,$content_type){
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
