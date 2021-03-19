<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;


class TaggingTagged extends Model
{
    use HasFactory;
    protected $fillable = [
        'taggable_id',
        'taggable_type',
        'tag_name',
        'tag_slug',
    ];

    public function posts(){
      return $this->belongsToMany(Post::class,'post_tagging_tag','tag_id','post_id')->withPivot('language_id')->withTimestamps();
    }
}
