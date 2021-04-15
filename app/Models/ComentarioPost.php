<?php

namespace App\Models;

use App\Models\CalificacionPost;
use App\Models\Post;
use App\Models\ConfigComentarioPost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'fullName',
        'comment',
        'publish',
        'count_answer',
        'count_nivels',
        'calification_id',
        'post_id',
        'config_id',
    ];

    public function scopeFilterByAttribute($query,$filter){
      if(!empty($filter)){
        $query->where('email', 'LIKE', '%'.$filter.'%')
              ->orWhere('fullName', 'LIKE', '%'.$filter.'%');
      }
    }

    public function posts(){
      return $this->belongsTo(Post::class)->withTimestamps();
    }

    public function calificacionCommentPosts(){
      return $this->belongsTo(CalificacionPost::class)->withTimestamps();
    }

    public function configuraciones(){
      return $this->hasOne(ConfigComentarioPost::class,'id','config_id')->withTimestamps();
    }
}
