<?php

namespace App\Models;

use App\Models\Paket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunctionIncluded extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];

    public function scopeFilterByAttribute($query,$filter){
      if(!empty($filter)){
        $query->where('name', 'LIKE', '%'.$filter.'%');
      }
    }

    public function pakets(){
      return $this->belongsToMany(Paket::class,'function_included_paket','function_id','paket_id')->withTimestamps();
    }
}
