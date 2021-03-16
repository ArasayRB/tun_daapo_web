<?php

namespace Database\Seeders;

use App\Models\ContentType;
use Illuminate\Database\Seeder;

class ContentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $content_type=new ContentType();
      $content_type->name='Post';
      $content_type->save();

      $content_type=new ContentType();
      $content_type->name='Service';
      $content_type->save();

      $content_type=new ContentType();
      $content_type->name='Contact';
      $content_type->save();

      $content_type=new ContentType();
      $content_type->name='Portfolio';
      $content_type->save();

      $content_type=new ContentType();
      $content_type->name='Paket';
      $content_type->save();

      $content_type=new ContentType();
      $content_type->name='Paket Type';
      $content_type->save();

      $content_type=new ContentType();
      $content_type->name='Section';
      $content_type->save();
    }
}
