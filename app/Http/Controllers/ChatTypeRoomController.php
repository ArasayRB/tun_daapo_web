<?php

namespace App\Http\Controllers;

use App\Models\ChatTypeRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatTypeRoomController extends Controller
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

    public function  getChatRoomTypeList(){
      $types_room=ChatTypeRoom::all();
      return $types_room;
    }

    public function getAllRoomTypesChat(Request $request){
      $filter=$request->searcher;
      $rooms=ChatTypeRoom::filterByAttribute($filter)
                      ->get();
      $rooms_searched=[];
      foreach($rooms as $room){
        $findText=stristr($room->name,$filter);
        if(!empty($findText)){
          $prop='name';
          $room->finded==$findText;
          $small_word=substr($findText,0,strlen($filter));
          $room->substr=$small_word;
          $room->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$room->name);
          $rooms_searched[]=$room;
        }
      }
      return $rooms_searched;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.chat.ChatRoomType.index');
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
        $type_room=new ChatTypeRoom();
        $type_room->name=request('name');
        $type_room->save();
        return $type_room;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChatTypeRoom  $chatTypeRoom
     * @return \Illuminate\Http\Response
     */
    public function update(string $locale,Request $request, int $chatTypeRoom)
    {
      $this->validator($request->all())->validate();
      $type_room=ChatTypeRoom::findOrFail($chatTypeRoom);
      $type_room->name=request('name');
      $type_room->update();
      return $type_room;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChatTypeRoom  $chatTypeRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $locale,int $chatTypeRoom)
    {
      $type_room=ChatTypeRoom::findOrFail($chatTypeRoom);
      $type_room->delete();
    }
}
