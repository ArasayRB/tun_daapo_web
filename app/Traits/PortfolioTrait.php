<?php

namespace App\Traits;
use App\Models\Portfolio;

trait PortfolioTrait {

    public function getPortfolioView(){
      $portfolioItem=Portfolio::all();
$content_type='Portfolio';
$portfolios_array_lang=[];
foreach ($portfolioItem as $portfolio) {
$portfolios_array_lang[]=$this->getTranslatedPortfolioBySigLang(app()->getLocale(),$portfolio->id,$content_type);

}

return $portfolios_array_lang;
    }

    public function getTranslatedPortfolioBySigLang($lang,$packet_id,$content_type){
      $id_lang=$this->getLangIdBySigla($lang);
      $content_types=$this->getContentTypeByName($content_type);
      $packet_translated=$this->getTranslatedTransItem($id_lang,$packet_id,$content_types[0]->id);
      $packet=$this->getPortfolio($packet_id);
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
