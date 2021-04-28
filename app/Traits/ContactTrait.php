<?php

namespace App\Traits;
use App\Models\Contact;

trait ContactTrait {
  public function getContact(){
    $id_contact=Contact::get()
                        ->first();
       $content_type='Contact';
       $contact_lang=$this->getTranslatedContactBySigLang(app()->getLocale(),$id_contact->id,$content_type);
       return $contact_lang;
  }

  public function getTranslatedContactBySigLang($lang,$contact_id,$content_type){
    $id_lang=$this->getLangIdBySigla($lang);
    $content_types=$this->getContentTypeByName($content_type);
    $contact_translated=$this->getTranslatedTransItem($id_lang,$contact_id,$content_types[0]->id);
    $contact=$this->getContactById($contact_id);
    $keys_array=array_keys($contact_translated);
    if(count($contact_translated)!=0){
      foreach($keys_array as $key){
        $contact[$key]=$contact_translated[$key]['content_trans'];
      }
      return $contact;
    }
    else{
      return $contact;
    }

  }

  public function getContactById($contact){
    return Contact::find($contact);
  }

  public function getTranslatedContactByLang(string $locale,$lang,$contact_id,$content_type){
    $id_lang=$this->getLangIdByName($lang);
    $content_types=$this->getContentTypeByName($content_type);
    $contact_translated=$this->getTranslatedTransItem($id_lang,$contact_id,$content_types[0]->id);
    $contact=$this->getContactById($contact_id);
    $contact->address=$contact_translated['address']['content_trans'];
    return $contact;
  }
}
