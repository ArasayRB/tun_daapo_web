<?php

namespace App\Http\Controllers;

use App\Models\ChatTypeMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatTypeMessageController extends Controller
{
       public function __construct()
       {
           $this->middleware('auth');
       }

       protected function validator(array $data)
       {
           return Validator::make($data, [
               'name' => ['required', 'string', 'max:255'],
           ]);
       }

       public function  getChatMessageTypeList(){
         $types_mssg=ChatTypeMessage::all();
         return $types_mssg;
       }

       public function getAllMessageTypesChat(Request $request){
         $filter=$request->searcher;
         $mssgs=ChatTypeMessage::filterByAttribute($filter)
                         ->get();
         $mssgs_searched=[];
         foreach($mssgs as $mssg){
           $findText=stristr($mssg->name,$filter);
           if(!empty($findText)){
             $prop='name';
             $mssg->finded==$findText;
             $small_word=substr($findText,0,strlen($filter));
             $mssg->substr=$small_word;
             $mssg->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$mssg->name);
             $mssgs_searched[]=$mssg;
           }
         }
         return $mssgs_searched;
       }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.chat.ChatMessageType.index');
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
          $type_mssg=new ChatTypeMessage();
          $type_mssg->name=request('name');
          $type_mssg->save();
          return $type_mssg;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChatTypeMessage  $chatTypeMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $chatTypeMessage)
    {
      $this->validator($request->all())->validate();
      $type_mssg=ChatTypeMessage::findOrFail($chatTypeMessage);
      $type_mssg->name=request('name');
      $type_mssg->update();
      return $type_mssg;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChatTypeMessage  $chatTypeMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $chatTypeMessage)
    {
      $type_mssg=ChatTypeMessage::findOrFail($chatTypeMessage);
      $type_mssg->delete();
    }
}
