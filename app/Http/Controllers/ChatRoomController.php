<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Traits\ChatTypeRoomTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ChatRoomController extends Controller
{
  use ChatTypeRoomTrait;

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getAllRoomsChat(Request $request){
    $filter=$request->searcher;
    $rooms=ChatRoom::filterByAttribute($filter)
                    ->get();
    $rooms_searched=[];
    for($i=0;$i<count($rooms);$i++){
      $findText=stristr($rooms[$i]->name,$filter);
      if(!empty($findText)){
        $prop='name';
        $rooms[$i]->finded==$findText;
        $small_word=substr($findText,0,strlen($filter));
        $rooms[$i]->substr=$small_word;
        $rooms[$i]->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$rooms[$i]->name);
        $type=$this->findTypeRoom($rooms[$i]->type_id);
        $rooms[$i]->type=$type;
        $rooms_searched[]=$rooms[$i];
      }
    }
    return $rooms_searched;
  }

  public function getChatRoomList(){
    $rooms=ChatRoom::with('users')
                   ->get();
    if($rooms!=null&&$rooms!=''&&$rooms!=[]){
    for($i=0;$i<count($rooms);$i++){
      $type=$this->findTypeRoom($rooms[$i]->type_id);
      $rooms[$i]->type=$type;
    }
  }
  return $rooms;
  }

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'name' => ['required', 'string', 'max:255'],
          'type_id' => ['required'],
      ]);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.chat.ChatRoom.index');
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
      $users=explode(',',request('selectedUsers'));
      $created=Carbon::now()->format('Y-m-d');
      $room_chat=new ChatRoom();
      $room_chat->name=request('name');
      $room_chat->type_id=request('type_id');
      $room_chat->save();
      for($i=0;$i<count($users);$i++) {
        $room_chat->users()->attach($users[$i],array('created_at'=>$created,'updated_at'=>$created));
      }
      return $room_chat;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChatRoom  $chatRoom
     * @return \Illuminate\Http\Response
     */
    public function update(string $locale,Request $request, $chatRoom)
    {
      $this->validator($request->all())->validate();
      $users=explode(',',request('users'));
      $updated=Carbon::now()->format('Y-m-d');
      $chat_room=ChatRoom::findOrFail($chatRoom);
      $chat_room->name=request('name');
      $chat_room->type_id=request('type_id');
      $chat_room->update();
      $chat_room->users()->detach();
      if(is_array($users)&&count($users)!=0){
        foreach ($users as $user) {
          $chat_room->users()->attach($user,array('updated_at'=>$updated));
        }
      }
      return $chat_room;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChatRoom  $chatRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $locale,$chatRoom)
    {
      $chat_room=ChatRoom::findOrFail($chatRoom);
      $chat_room->users()->detach();
      $chat_room->delete();
    }
}
