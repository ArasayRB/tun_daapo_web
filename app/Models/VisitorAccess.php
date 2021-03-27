<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorAccess extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip_visitor',
        'date_access',
        'accept_privacy_pol',
        'date_privacy_pol',
        'accept_terms_cond',
        'date_terms_cond',
        'accept_cookies',
        'date_cookies',
    ];
}
