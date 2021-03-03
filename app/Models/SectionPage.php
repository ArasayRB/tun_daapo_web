<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionPage extends Model
{
    use HasFactory;
    protected $fillable = [
        'img',
        'title',
        'description'
    ];
}