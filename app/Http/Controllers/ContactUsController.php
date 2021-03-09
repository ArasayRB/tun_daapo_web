<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Traits\MessageTrait;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
  use MessageTrait;

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'email' => ['required', 'string', 'email', 'max:255'],
          'name' => ['required', 'string'],
          'message' => ['required'],
      ]);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

       public function store(Request $request)
       {
           $this->validator($request->all())->validate();
           $contact=new ContactUs;
           $contact->email=request('email');
           $contact->name=request('name');
           $contact->message=request('message');
           $contact->save();
           $this->contactSend($contact);
           $this->contactTunDaapoSend($contact,request('company_email'));
           return $contact;
       }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function show(ContactUs $contactUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactUs $contactUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactUs $contactUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contactUs)
    {
        //
    }
}
