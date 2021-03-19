<?php

namespace App\Models;

use App\Models\Translate;
use App\Models\Keyword;
use App\Models\TagLang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
  use HasFactory;
  protected $fillable = [
      'language',
      'sigla',
  ];

  public function scopeFilterByAttribute($query,$filter){
    if(!empty($filter)){
      $query->where('language', 'LIKE', '%'.$filter.'%')
            ->orWhere('sigla', 'LIKE', '%'.$filter.'%');
    }
  }

  public function translates(){
    return $this->belongsToMany(Translate::class,'translate_language','language_id','translate_id')->withPivot('content_trans','id')->withTimestamps();
  }

  public function taglangs(){
    return $this->belongsToMany(TagLang::class);
  }

  public function keywords(){
    return $this->belongsToMany(Keyword::class)->withTimestamps();
  }
}
