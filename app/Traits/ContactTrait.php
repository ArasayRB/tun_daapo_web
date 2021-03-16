<?php

namespace App\Traits;
use App\Models\Contact;

trait ContactTrait {
  public function getContact(){
    $id_contact=Contact::get()
                        ->first();
    return $id_contact;
  }

  public function getContactById($contact){
    return Contact::find($contact);
  }

  public function getTranslatedContactByLang($lang,$contact_id,$content_type){
    $id_lang=$this->getLangIdByName($lang);
    $content_types=$this->getContentTypeByName($content_type);
    $contact_translated=$this->getTranslatedTransItem($id_lang,$contact_id,$content_types[0]->id);
    $contact=$this->getContactById($contact_id);
    $contact->address=$contact_translated['address']['content_trans'];
    return $contact;
  }
}
