<?php

namespace App\Http\Controllers;

use App\Models\Suscription;
use Illuminate\Http\Request;
use App\Traits\MessageTrait;
use Illuminate\Support\Facades\Lang;

class SuscriptionController extends Controller
{
  use MessageTrait;

  public function store(Request $request){
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
