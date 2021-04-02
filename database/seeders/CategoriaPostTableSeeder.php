<?php

namespace Database\Seeders;

use App\Models\CategoriaPost;
use Illuminate\Database\Seeder;

class CategoriaPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categoria=new CategoriaPost();
      $categoria->category_post='Emprendimiento y Empoderamiento';
      $categoria->description='Temas relacionados con emprendimiento, empoderamiento, trabajo por cuenta propia, negocios propios';
      $categoria->save();

      $categoria=new CategoriaPost();
      $categoria->category_post='Programacion';
      $categoria->description='Sobre temas relacionados con prgramacion desde distintos lenguajes';
      $categoria->save();

      $categoria=new CategoriaPost();
      $categoria->category_post='Marketing Digital';
      $categoria->description='Desarrollo de estrategias, planes de Marketing Digital, optimizacion SEO en webs, imagenes, publicaciones, estrategias SEM';
      $categoria->save();
    }
}
