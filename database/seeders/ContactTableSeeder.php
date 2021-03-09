<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactTableSeeder extends Seeder
{
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
    }
}
