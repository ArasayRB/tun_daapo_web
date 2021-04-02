<?php

namespace App\Models;

use App\Models\ChatTypeMessage;
use App\Models\ChatMessage;
use App\Models\User;
use App\Models\ChatRoom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'user_id',
        'to_user_id',
        'room_id',
        'type_id',
        'date',
    ];

    public function types(){
      $this->hasOne(ChatTypeMessage::class,'id','type_id');
    }

    public function user(){
      $this->hasOne(User::class,'id','user_id');
    }

    public function toUser(){
      $this->hasOne(User::class,'id','to_user_id');
    }

    public function rooms(){
      $this->hasOne(ChatRoom::class,'id','room_id');
    }
}
