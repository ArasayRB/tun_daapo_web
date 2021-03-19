<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'language_id',
    ];
    public function posts(){
      return $this->belongsToMany(Post::class,'keyword_post','keyword_id','post_id')->withTimestamps();
    }

    public function languages(){
      return $this->belongsTo(Language::class)->withTimestamps();
    }

}
