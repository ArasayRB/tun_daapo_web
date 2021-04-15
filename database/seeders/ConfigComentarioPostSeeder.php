<?php

namespace Database\Seeders;

use App\Models\ConfigComentarioPost;
use Illuminate\Database\Seeder;

class ConfigComentarioPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $config=new ConfigComentarioPost();
      $config->max_nivel=3;
      $config->max_answers=3;
      $config->save();
    }
}
