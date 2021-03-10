<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getAllContacts(Request $request){
    $filter=$request->searcher;
    $contacts=Contact::filterByAttribute($filter)
                    ->get();
    $contacts_searched=[];
    foreach($contacts as $contact){
      $findAddress=stristr($contact->address,$filter);
      $findText=stristr($contact->email,$filter);
      $findPhone=stristr($contact->phone,$filter);
      if(!empty($findText)){
        $prop='email';
        $contact->finded==$findText;
        $small_word=substr($findText,0,strlen($filter));
        $contact->substr=$small_word;
        $contact->name=$contact->email;
        $contact->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$contact->email);
        $contacts_searched[]=$contact;
      }
      if(!empty($findAddress)){

          $prop='address';
          $contact->finded==$findAddress;
          $small_word=substr($findAddress,0,strlen($filter));
          $contact->substr=$small_word;
          $contact->name=$contact->address;
          $contact->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$contact->address);
          $contacts_searched[]=$contact;
      }
      if(!empty($findPhone)){

          $prop='phone';
          $contact->finded==$findPhone;
          $small_word=substr($findPhone,0,strlen($filter));
          $contact->substr=$small_word;
          $contact->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$contact->phone);
          $contacts_searched[]=$contact;
      }
    }
    return $contacts_searched;
  }

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'email' => ['required', 'string', 'email', 'max:255'],
          'address' => ['required', 'string', 'max:255'],
          'phone' => ['required', 'string'],
      ]);
  }

  public function getContactList(){
    $contacts=Contact::all();
    return $contacts;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.page_resources.contact.index');
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
      $contact=new Contact();
      $contact->email=request('email');
      $contact->address=request('address');
      $contact->phone=request('phone');
      $contact->map=request('map');
      $contact->save();
      return $contact;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
      $this->validator($request->all())->validate();
      $contacto=Contact::findOrFail($contact->id);
      $contacto->email=request('email');
      $contacto->address=request('address');
      $contacto->phone=request('phone');
      $contacto->map=request('map');
      $contacto->update();
      return $contacto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
      $contact=Contact::findOrFail($contact->id);
      $contact->delete();
    }
}
