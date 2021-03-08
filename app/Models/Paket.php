<?php

namespace App\Models;

use App\Models\Service;
use App\Models\PaketType;
use App\Models\FunctionIncluded;
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
        'type_id',
    ];

    public function services(){
      return $this->belongsToMany(Service::class,'paket_service','paket_id','service_id')->withPivot('status','status_date','unstatus_date')->withTimestamps();
    }

    public function pakettypes(){
      return $this->belongsTo(PaketType::class,'type_id')->withTimestamps();
    }

    public function functions(){
      return $this->belongsToMany(PaketType::class,'function_included_paket','paket_id','function_id')->withTimestamps();
    }
}
