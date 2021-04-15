<?php
namespace App\Traits;
use App\Models\ConfigComentarioPost;

trait ConfigComentarioPostTrait {

  public function getConfigComment(){
    $id_cal=ConfigComentarioPost::first();
                            return $id_cal;
  }

}
