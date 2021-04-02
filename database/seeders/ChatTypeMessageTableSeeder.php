<?php

namespace Database\Seeders;

use App\Models\ChatTypeMessage;
use Illuminate\Database\Seeder;

class ChatTypeMessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $type_message=new ChatTypeMessage();
      $type_message->name='Record';
      $type_message->save();

      $type_message=new ChatTypeMessage();
      $type_message->name='Video';
      $type_message->save();

      $type_message=new ChatTypeMessage();
      $type_message->name='Image';
      $type_message->save();

      $type_message=new ChatTypeMessage();
      $type_message->name='Text';
      $type_message->save();
    }
}
