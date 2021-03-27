<?php

namespace App\Http\Controllers;

use App\Models\AskBudget;
use Illuminate\Http\Request;
use App\Traits\MessageTrait;
use App\Traits\VisitorAccessTrait;
use App\Traits\PaketTrait;
use Illuminate\Support\Facades\Validator;

class AskBudgetController extends Controller
{
  use MessageTrait, PaketTrait, VisitorAccessTrait;

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'email' => ['required', 'string', 'email', 'max:255'],
          'name_or_company' => ['required', 'string', 'max:255'],
          'contact_phone' => ['required', 'string'],
      ]);
  }

    public function store(Request $request){
      $ip=$request->ip();
      $is_there=$this->isIp($ip);
      if($is_there->accept_privacy_pol==false){
         $this->updIpDataPol(1,$is_there->ip_visitor);
      }
      $this->validator($request->all())->validate();
      $ask_budget=new AskBudget();
      $ask_budget->email=request('email');
      $ask_budget->name_or_company=request('name_or_company');
      $ask_budget->contact_phone=request('contact_phone');
      if(request('paket_name')!=''){
        $paket=$this->getPaketByName(request('paket_name'));
        $ask_budget->paket_id=$paket[0]->id;
      }
      $ask_budget->save();
      $this->budgetSend($ask_budget);
      $this->budgetTunDaapoSend($ask_budget,request('company_email'));
      return $ask_budget;
    }
}
