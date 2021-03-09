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
}
