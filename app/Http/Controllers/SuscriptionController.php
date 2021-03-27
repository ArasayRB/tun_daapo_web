<?php

namespace App\Http\Controllers;

use App\Models\Suscription;
use Illuminate\Http\Request;
use App\Traits\MessageTrait;
use App\Traits\VisitorAccessTrait;
use Illuminate\Support\Facades\Lang;

class SuscriptionController extends Controller
{
  use MessageTrait, VisitorAccessTrait;

  public function store(Request $request){
    $ip=$request->ip();
    $is_there=$this->isIp($ip);
    if($is_there->accept_privacy_pol==false){
       $this->updIpDataPol(1,$is_there->ip_visitor);
    }
    $data=request()->validate([
      'email'=> 'required|email',
      'name'=> 'required',
    ]);
    $suscripcion= new Suscription();
    $suscripcion->email=request('email');
    $suscripcion->name=request('name');
    $suscripcion->save();
    $this->newsletterSend($suscripcion);
    return $suscripcion;

  }

  public function delete($suscriptor){
    $emailSus=Suscription::find($suscriptor);
    $email=$emailSus->email;
    $emailSus->delete();
    return view('welcome_tun_daapo',['message'=>''.$email.': '.Lang::get('Unsubscribe Successfully')]);
  }
}
