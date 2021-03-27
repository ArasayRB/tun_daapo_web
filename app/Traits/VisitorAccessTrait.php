<?php

namespace App\Traits;
use App\Models\VisitorAccess;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

trait VisitorAccessTrait {
  public function isIp(string $ip){
  $date=Carbon::now()->format('Y-m-d');
    $ip_finded=VisitorAccess::firstOrCreate(['ip_visitor'=>$ip],['ip_visitor'=>$ip,'date_access'=>$date]);
    return $ip_finded;
  }

  public function updIpDataPol($policy,string $ip){
    $date=Carbon::now()->format('Y-m-d');
    $ip_finded=VisitorAccess::where('ip_visitor',$ip)
                            ->get();
    $ip_finded[0]->accept_privacy_pol=$policy;
    $ip_finded[0]->date_privacy_pol=$date;
    $ip_finded[0]->update();
    return $ip_finded;
  }

  public function updIpDataCook($cookie,string $ip){
    $date=Carbon::now()->format('Y-m-d');
    $ip_finded=VisitorAccess::where('ip_visitor',$ip)
                            ->get();
    $ip_finded[0]->accept_cookies=$cookie;
    $ip_finded[0]->date_cookies=$date;
    $ip_finded[0]->update();
    return $ip_finded;
  }

  public function updIpDataTerm($term,string $ip){
    $date=Carbon::now()->format('Y-m-d');
    $ip_finded=VisitorAccess::where('ip_visitor',$ip)
                            ->get();
    $ip_finded[0]->accept_terms_cond=$term;
    $ip_finded[0]->date_terms_cond=$date;
    $ip_finded[0]->update();
    return $ip_finded;
  }
}
