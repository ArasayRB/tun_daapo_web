<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Traits\ContentTypeTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;
use App\Traits\ContactTrait;

class ContactTableSeeder extends Seeder
{
  use ContentTypeTrait, TranslateTrait, LanguageTrait, ContactTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $contact=new Contact();
      $contact->email='ing.arasay@gmail.com';
      $contact->address='Camilo Cienfuegos #180 A entre José Martí y Miguel Calzada, Trinidad, Sacti Spíritus, Cuba | CP 62600';
      $contact->phone=+5353419001;
      $contact->save();
      $contentType='Contact';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_address='At 180 A Camilo Cienfuegos, between José Martí and Miguel Calzada street. Trinidad, Cuba, Sancti Spíritus | CP-62600';
      $data_trans=array(
        ['id_content_trans'=>$contact->id,
        'content'=>$contact['address'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'address',
        'content_trans'=>$content_address]
      );
      $this->storeTranslate($data_trans);
    }
}
