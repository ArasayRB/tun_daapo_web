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

    public function getService($service){
      return Service::find($service);
    }

    public function getTranslatedServiceByLang($lang,$service_id,$content_type){
      $id_lang=$this->getLangIdByName($lang);
      $content_types=$this->getContentTypeByName($content_type);
      $service_translated=$this->getTranslatedTransItem($id_lang,$service_id,$content_types[0]->id);
      $service=$this->getService($service_id);
      $service->name=$service_translated['name']['content_trans'];
      $service->description=$service_translated['description']['content_trans'];
      return $service;
    }
}
