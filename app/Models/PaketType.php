<?php

namespace App\Models;

use App\Models\Paket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function scopeFilterByAttribute($query,$filter){
      if(!empty($filter)){
        $query->where('name', 'LIKE', '%'.$filter.'%');
      }
    }

    public function pakets(){
      return $this->belongsToMany(Paket::class)->withTimestamps();
    }

}
