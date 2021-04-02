<?php

namespace Database\Seeders;

use App\Models\ChatTypeRoom;
use Illuminate\Database\Seeder;

class ChatTypeRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $type_room=new ChatTypeRoom();
      $type_room->name='Private';
      $type_room->save();

      $type_room=new ChatTypeRoom();
      $type_room->name='Share';
      $type_room->save();
    }
}
