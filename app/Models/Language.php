<?php

namespace App\Models;

use App\Models\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
  use HasFactory;
  protected $fillable = [
      'language',
      'sigla',
  ];

  public function translates(){
    return $this->belongsToMany(Translate::class,'translate_language','language_id','translate_id')->withPivot('content_trans','id')->withTimestamps();
  }
}
