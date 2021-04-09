<?php

namespace App\Models;

use App\Models\ChatTypeRoom;
use App\Models\ChatRoom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatTypeRoom extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function scopeFilterByAttribute($query,$filter){
      if(!empty($filter)){
        $query->where('name', 'LIKE', '%'.$filter.'%');
      }
    }

    public function rooms(){
      $this->hasMany(ChatRoom::class);
    }
}
