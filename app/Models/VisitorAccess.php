<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

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



    public function sharesVisitorsPosts(){
      return $this->belongsToMany(Post::class,'post_share_visitors','visitor_id','post_id')->withPivot('date','page','neth')->withTimestamps();
    }

    public function visitorsPosts(){
      return $this->belongsToMany(Post::class,'post_visitor_accesses','visitor_id','post_id')->withPivot('date','like','like_date','read','read_date')->withTimestamps();
    }
}
