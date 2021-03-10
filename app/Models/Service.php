<?php

namespace App\Models;

use App\Models\Paket;
use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'status',
        'price',
    ];

    public function scopeFilterByAttribute($query,$filter){
      if(!empty($filter)){
        $query->where('name', 'LIKE', '%'.$filter.'%');
      }
    }

    public function paquetes(){
      return $this->belongsToMany(Paket::class,'paket_service','service_id','paket_id')->withPivot('status','status_date','unstatus_date')->withTimestamps();
    }
    public function portfolios(){
      return $this->belongsToMany(Portfolio::class,'portfolio_service','service_id','portfolio_id')->withTimestamps();
    }
}
