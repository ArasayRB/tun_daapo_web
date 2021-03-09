<?php

namespace App\Http\Controllers;

use App\Models\AskBudget;
use Illuminate\Http\Request;
use App\Traits\MessageTrait;
use Illuminate\Support\Facades\Validator;

class AskBudgetController extends Controller
{
  use MessageTrait;

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'email' => ['required', 'string', 'email', 'max:255'],
          'name_or_company' => ['required', 'string', 'max:255'],
          'contact_phone' => ['required', 'string'],
      ]);
  }

    public function store(Request $request){
      $this->validator($request->all())->validate();
      $ask_budget=new AskBudget();
      $ask_budget->email=request('email');
      $ask_budget->name_or_company=request('name_or_company');
      $ask_budget->contact_phone=request('contact_phone');
      $ask_budget->save();
      $this->budgetSend($ask_budget);
      $this->budgetTunDaapoSend($ask_budget,request('company_email'));
      return $ask_budget;
    }
}
