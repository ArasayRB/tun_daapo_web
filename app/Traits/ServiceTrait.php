<?php

namespace App\Traits;
use App\Models\Service;

trait ServiceTrait {
    public function store($service) {
        // Fetch all the users from the 'users' table.
        $services = new Service();
        $services->name=$service;
        $services->save();
        return $services;
    }

    public function getServiceIf($service){
      $services = Service::firstOrCreate(['name'=>$service],['name'=>$service]);

                   return $services;
    }

    public function getAllService(){
      $services = Service::all();

                   return $services;
    }

    public function getServicesInOffer(){
      $services=Service::where('status',1)
                          ->get();
      return $services;
    }
}
