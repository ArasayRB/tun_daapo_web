<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $fillable = [
        'img',
        'empresa_solicitante',
        'project_name',
        'description',
        'service_id'
    ];

    public function scopeFilterByAttribute($query,$filter){
      if(!empty($filter)){
        $query->with('services')
              ->where('empresa_solicitante', 'LIKE', '%'.$filter.'%')
              ->orWhere('project_name', 'LIKE', '%'.$filter.'%');
      }
    }

    public function services(){
      return $this->belongsToMany(Service::class,'portfolio_service','portfolio_id','service_id')->withTimestamps();
    }
}
