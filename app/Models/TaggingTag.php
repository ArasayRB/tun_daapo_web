<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TaggingTagTrait;
use App\Models\Post;
use App\Models\PostTaggingTag;

class TaggingTag extends Model
{
  use TaggingTagTrait;
    use HasFactory;
    protected $fillable = [
        'slug',
        'name',
        'suggest',
        'count',
        'tag_group_id',
        'description',
    ];



    public function posts(){
      return $this->belongsToMany(Post::class,'post_tagging_tag','tag_id','post_id')->withPivot('language_id')->withTimestamps();
    }

    public function posttaggingtags(){
      return $this->belongsToMany(PostTaggingTag::class);
    }
}
