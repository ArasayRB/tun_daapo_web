<?php

namespace App\Traits;
use App\Models\Portfolio;

trait PortfolioTrait {

    public function getPortfolioView(){
      $portfolioItem=Portfolio::all();
      return $portfolioItem;
    }

    public function getPortfolio($portfolio){
      $portfolios=Portfolio::with('services')
                   ->where('id',$portfolio)
                   ->first();
      return $portfolios;
    }

    public function getTranslatedPortfolioByLang($lang,$portfolio_id,$content_type){
      $id_lang=$this->getLangIdByName($lang);
      $content_types=$this->getContentTypeByName($content_type);
      $portfolio_translated=$this->getTranslatedTransItem($id_lang,$portfolio_id,$content_types[0]->id);
      $portfolio=$this->getPortfolio($portfolio_id);
      $portfolio->description=$portfolio_translated['description']['content_trans'];
      return $portfolio;
    }
}
