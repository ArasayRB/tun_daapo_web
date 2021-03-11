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
}
