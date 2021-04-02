<?php

namespace Database\Seeders;

use App\Models\ChatTypeRoom;
use App\Models\ChatRoom;
use Illuminate\Database\Seeder;

class ChatRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $room_type=ChatTypeRoom::where('name','Private')
                             ->first();
      $room=new ChatRoom();
      $room->name='Talk Contact';
      $room->type_id=$room_type->id;
      $room->save();

      $room=new ChatRoom();
      $room->name='Admin Contact';
      $room->type_id=$room_type->id;
      $room->save();

      $room_type=ChatTypeRoom::where('name','Share')
                             ->first();
      $room=new ChatRoom();
      $room->name='Share Contact';
      $room->type_id=$room_type->id;
      $room->save();
    }
}
