<?php

namespace App\Traits;
use App\Models\Portfolio;

trait PortfolioTrait {

    public function getPortfolioView(){
      $sectionItem=Portfolio::all();
      return $sectionItem;
    }
}
