<?php

namespace App\Models;

use App\Models\ChatTypeMessage;
use App\Models\ChatMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatTypeMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function messages(){
      $this->hasMany(ChatMessage::class);
    }
}
