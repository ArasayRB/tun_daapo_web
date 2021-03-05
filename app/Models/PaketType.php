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

    public function pakets(){
      return $this->belongsToMany(Paket::class)->withTimestamps();
    }

}
