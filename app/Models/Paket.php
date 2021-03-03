<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'name_button',
        'description',
        'price',
    ];

    public function services(){
      return $this->belongsToMany(Service::class,'paket_service','paket_id','service_id')->withPivot('status','status_date','unstatus_date')->withTimestamps();
    }
}
