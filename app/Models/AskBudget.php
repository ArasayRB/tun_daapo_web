<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AskBudget extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'name_or_company',
        'contact_phone',
        'paket_id',
    ];
}
