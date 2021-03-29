<?php

namespace App\Traits;
use App\Models\PostVisitorAccess;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

trait PostVisitorAccessTrait {
  public function viewedVisitor($ip){
    $visitor=PostVisitorAccess::where('visitor_id',$ip)
                              ->first();
    return $visitor;

  }
}
