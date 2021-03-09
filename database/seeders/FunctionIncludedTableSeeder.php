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

      $paket_type=new FunctionIncluded();
      $paket_type->name='Diseño e imágen de tu página web';
      $paket_type->save();

      $paket_type=new FunctionIncluded();
      $paket_type->name='Adaptada a móviles y 100% responsive';
      $paket_type->save();

      $paket_type=new FunctionIncluded();
      $paket_type->name='CMS Autogestionable';
      $paket_type->save();

      $paket_type=new FunctionIncluded();
      $paket_type->name='Leyes obligatorias web(LSSI,RGPD y Cookies)';
      $paket_type->save();

      $paket_type=new FunctionIncluded();
      $paket_type->name='Sitio web seguro (HTTPS)';
      $paket_type->save();

      $paket_type=new FunctionIncluded();
      $paket_type->name='Página web o Blog';
      $paket_type->save();

      $paket_type=new FunctionIncluded();
      $paket_type->name='5 Páginas';
      $paket_type->save();

      $paket_type=new FunctionIncluded();
      $paket_type->name='Imágenes de stock';
      $paket_type->save();

      $paket_type=new FunctionIncluded();
      $paket_type->name='Posicionamiento en Google SEO';
      $paket_type->save();

      $paket_type=new FunctionIncluded();
      $paket_type->name='10 Páginas';
      $paket_type->save();

      $paket_type=new FunctionIncluded();
      $paket_type->name='2 idioma';
      $paket_type->save();

      $paket_type=new FunctionIncluded();
      $paket_type->name='Chat de contacto';
      $paket_type->save();

      $paket_type=new FunctionIncluded();
      $paket_type->name='Multidioma';
      $paket_type->save();

      $paket_type=new FunctionIncluded();
      $paket_type->name='Textos de Calidad';
      $paket_type->save();

      $paket_type=new FunctionIncluded();
      $paket_type->name='Importación de tu actual web';
      $paket_type->save();

      $paket_type=new FunctionIncluded();
      $paket_type->name='Página web, Blog o Tienda Online';
      $paket_type->save();
    }
}
