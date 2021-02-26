<?php

namespace App\Models;

use App\Models\CalificacionPost;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'fullName',
        'comment',
        'calification_id',
        'post_id',
    ];

    public function posts(){
      return $this->belongsTo(Post::class)->withTimestamps();
    }

    public function calificacionCommentPosts(){
      return $this->belongsTo(CalificacionPost::class)->withTimestamps();
    }
}
