<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaPost extends Model
{
    use HasFactory;protected $fillable = [
        'category_post',
        'description',
    ];

    public function scopeFilterByAttribute($query,$filter){
      if(!empty($filter)){
        $query->where('category_post', 'LIKE', '%'.$filter.'%');
      }
    }

    public function posts(){
      return $this->hasMany(Post::class)->withTimestamps();
    }
}
