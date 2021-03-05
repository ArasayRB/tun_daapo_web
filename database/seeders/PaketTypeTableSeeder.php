<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaketType;

class PaketTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $paket_type=new PaketType();
      $paket_type->name='Básico';
      $paket_type->save();

      $paket_type=new PaketType();
      $paket_type->name='Avanzado';
      $paket_type->save();

      $paket_type=new PaketType();
      $paket_type->name='Profesional';
      $paket_type->save();

      $paket_type=new PaketType();
      $paket_type->name='Premium';
      $paket_type->save();

      $paket_type=new PaketType();
      $paket_type->name='Oferta Especial';
      $paket_type->save();
    }
}
