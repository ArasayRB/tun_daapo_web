<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatRoom;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Events\NewChatMessage;

class ChatController extends Controller
{
  use UserTrait;
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function rooms(Request $request){
    return ChatRoom::with('users')
                   ->where('type_id',1)
                   ->get();
  }

  public function messages(Request $request, $roomId){
    $messages=ChatMessage::where('room_id',$roomId)
                      ->orderBy('created_at','ASC')
                      ->get();
    for($i=0;$i<count($messages);$i++) {
      $user=$this->getUserById($messages[$i]->user_id);
      $messages[$i]->user=$user;
    }

    return $messages;
  }

  public function newMessage(Request $request, $roomId){
    $date=Carbon::now()->format('Y-m-d');
    $new_message=new ChatMessage();
    $new_message->user_id=Auth::id();
    $new_message->room_id=$roomId;
    $new_message->message=$request->message;
    $new_message->type_id=4;
    $new_message->date=$date;
    $new_message->save();

    broadcast(new NewChatMessage($new_message,auth()->user()))->toOthers();
    return $new_message;

  }
}
