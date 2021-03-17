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
  $content_type='Service';
  $services_array_lang=[];
  foreach ($services as $service) {
    $services_array_lang[]=$this->getTranslatedServiceBySigLang(app()->getLocale(),$service->id,$content_type);
  }

  return $services_array_lang;
    }

    public function getTranslatedServiceBySigLang($lang,$service_id,$content_type){
      $id_lang=$this->getLangIdBySigla($lang);
      $content_types=$this->getContentTypeByName($content_type);
      $service_translated=$this->getTranslatedTransItem($id_lang,$service_id,$content_types[0]->id);
      $service=$this->getservice($service_id);
      $keys_array=array_keys($service_translated);
      if(count($service_translated)!=0){
        foreach($keys_array as $key){
          $service[$key]=$service_translated[$key]['content_trans'];
        }
        return $service;
      }
      else{
        return $service;
      }

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
