<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FileType;
use App\Models\Post;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'file',
        'description',
        'slug',
        'extencion',
        'downloads',
        'shares',
        'watches',
        'file_type',
    ];

    public function fileTypes(){
      return $this->belongsTo(FileType::class,'file_type')->withTimestamps();
    }

  public function posts(){
      return $this->belongsToMany(Post::class)->withTimestamps();
    }
}
