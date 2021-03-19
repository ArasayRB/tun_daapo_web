<?php

namespace App\Models;

use App\Models\CategoriaPost;
use App\Models\File;
use App\Models\TagLang;
use App\Models\ComentarioPost;
use App\Models\Keyword;
use App\Models\TaggingTag;
use App\Models\User;
use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; use Taggable;
    protected $fillable = [
        'title',
        'default_lang',
        'content',
        'summary',
        'publicate_state',
        'img_url',
        'video_url',
        'qr_img_url',
        'user_id',
        'category_id',
        'cant_access_read',
        'cant_likes',
        'cant_shares',
        'tags',
        'slug',
    ];

    public function scopeFilterByAttribute($query,$filter){
      if(!empty($filter)){
        $query->with('categoriaPosts')
              ->with('keywords')
              ->with('users')
              ->where('title', 'LIKE', '%'.$filter.'%');
      }
    }

    public function users(){
      return $this->belongsTo(User::class,'user_id');
    }

    public function taggingtags(){
      return $this->belongsToMany(TaggingTag::class,'post_tagging_tag','post_id','tag_id')->withPivot('language_id')->withTimestamps();
    }

    public function getlangTagPost($lang,$post){
      return PostTaggingTag::where('post_id',$post)
                           ->where('tag_id',$lang)
                           ->get();
    }


    public function categoriaPosts(){
      return $this->belongsTo('App\Models\CategoriaPost','category_id');
    }

    public function keywords(){
      return $this->belongsToMany(Keyword::class,'keyword_post','post_id','keyword_id')->withTimestamps();
    }

    public function comentarioPosts(){
      return $this->hasMany(ComentarioPost::class)->withTimestamps();
    }

    public function files(){
      return $this->belongsToMany(File::class)->withTimestamps();
    }
}
