<?php

namespace App\Traits;
use App\Models\Contact;

trait ContactTrait {
  public function getContact(){
    $id_contact=Contact::get()
                        ->first();
    return $id_contact;
  }
}
