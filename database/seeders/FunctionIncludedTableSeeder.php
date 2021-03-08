<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FunctionIncluded;

class FunctionIncludedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $paket_type=new FunctionIncluded();
      $paket_type->name='3 Páginas';
      $paket_type->save();

      $paket_type=new FunctionIncluded();
      $paket_type->name='1 Idioma';
      $paket_type->save();
    }
}
