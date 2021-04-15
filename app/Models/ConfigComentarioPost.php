<?php

namespace App\Models;

use App\Models\ComentarioPost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigComentarioPost extends Model
{
    use HasFactory;
    protected $fillable = [
          'max_nivel',
          'max_answers',
      ];

      public function scopeFilterByAttribute($query,$filter){
        if(!empty($filter)){
          $query->where('max_nivel', 'LIKE', '%'.$filter.'%')
                ->orWhere('max_answers', 'LIKE', '%'.$filter.'%');
        }
      }

      public function comentarios(){
        $this->belongsToMany(ComentarioPost::class);
      }
}
