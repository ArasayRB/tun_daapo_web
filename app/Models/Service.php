<?php

namespace App\Models;

use App\Models\Paket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
    ];
    public function paquetes(){
      return $this->belongsToMany(Paket::class,'paket_service','service_id','paket_id')->withPivot('status','status_date','unstatus_date')->withTimestamps();
    }
}
