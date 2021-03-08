<?php

namespace App\Traits;
use App\Models\FunctionIncluded;

trait FunctionIncludedTrait {
    public function store($funct) {
        // Fetch all the users from the 'users' table.
        $functs = new FunctionIncluded();
        $functs->name=$funct;
        $functs->save();
        return $functs;
    }

    public function getFunctionIncludedIf($funct){
      $functs = FunctionIncluded::firstOrCreate(['name'=>$funct],['name'=>$funct]);

                   return $functs;
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
