<?php
namespace App\Traits;
use App\Models\CalificacionPost;

trait CalificacionPostTrait {


  public function allCalifications(){
    $califications=CalificacionPost::all();
  return  $califications;
  }

  public function calificationByVal(int $id){
    $id_cal=CalificacionPost::where('calification',$id)
                            ->get();
                            return $id_cal;
  }

  public function calificationById(int $id){
    $id_cal=CalificacionPost::find($id);
                            return $id_cal;
  }

}
