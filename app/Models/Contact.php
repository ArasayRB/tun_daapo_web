<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'address',
        'phone',
        'map'
    ];

    public function scopeFilterByAttribute($query,$filter){
      if(!empty($filter)){
        $query->where('phone', 'LIKE', '%'.$filter.'%')
              ->orWhere('email', 'LIKE', '%'.$filter.'%')
              ->orWhere('address', 'LIKE', '%'.$filter.'%');
      }
    }
}
