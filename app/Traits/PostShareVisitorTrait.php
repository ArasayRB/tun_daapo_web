<?php

namespace App\Traits;
use App\Models\PostShareVisitor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

trait PostShareVisitorTrait {
  public function sharedVisitor($ip){
    $visitor=PostShareVisitor::find($ip);
    return $visitor;

  }
}
