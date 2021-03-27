<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostVisitorAccess extends Model
{
    use HasFactory;
    protected $fillable = [
        'visitor_id',
        'post_id',
        'date',
        'like',
        'like_date',
        'read',
        'read_date',
    ];
}
