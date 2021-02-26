<?php

namespace App\Models;

use App\Models\ComentarioPost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'calification',
        'description',
        'img_url',
    ];

    public function comentariosPosts(){
      return $this->hasMany(ComentarioPost::class)->withTimestamps();
    }
}
