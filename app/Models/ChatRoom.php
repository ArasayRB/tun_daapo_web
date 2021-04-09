<?php

namespace App\Models;

use App\Models\ChatTypeRoom;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type_id',
    ];

    public function scopeFilterByAttribute($query,$filter){
      if(!empty($filter)){
        $query->with('users')
              ->where('name', 'LIKE', '%'.$filter.'%');
      }
    }

    public function types(){
      $this->hasOne(ChatTypeRoom::class,'id','type_id');
    }

    public function users(){
      return $this->belongsToMany(User::class,'chat_room_user','room_id','user_id')->withTimestamps();
    }
}
