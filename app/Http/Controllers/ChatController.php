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

  public function getUserMessage($roomId,$userId){
    $messages=ChatMessage::where('room_id',$roomId)
                         ->where('user_id',auth()->user()->id)
                         ->where('to_user_id',$userId)
                         ->orderBy('created_at','DESC')
                         ->take(50)
                         ->get();
      $messages_receive=ChatMessage::where('room_id',$roomId)
                           ->where('user_id',$userId)
                           ->where('to_user_id',auth()->user()->id)
                           ->orderBy('created_at','DESC')
                           ->take(50)
                           ->get();
    $allUserToUser=[];
    for($i=0;$i<count($messages);$i++) {
      $allUserToUser[]=$this->addToUserTime($messages[$i]);
    }

    for($i=0;$i<count($messages_receive);$i++) {
    $allUserToUser[]=$this->addToUserTime($messages_receive[$i]);
    }
    $allUserTUser=$this->orderBy($allUserToUser, 'created_at', 'desc');

    return $allUserTUser;
  }

  public function addToUserTime($messages_receive){
     $user=$this->getUserById($messages_receive->user_id);
      $toUser=$this->getUserById($messages_receive->to_user_id);

     $data=Carbon::parse($messages_receive->created_at);
      $messages_receive->user=$user;
       $messages_receive->to_user=$toUser;
      $messages_receive->time=$data->hour.':'.$data->minute;
      return $messages_receive;

  }

  public function orderBy($items, $attr, $order)
{
$temp=[];
for($i=0;$i<count($items);$i++){
  for($j=1;$j<count($items)-$i;$j++){
    if($order=='asc'){
    if ($items[$j - 1][$attr] > $items[$j][$attr]) {
        $temp = $items[$j - 1];
        $items[$j - 1] = $items[$j];
        $items[$j] = $temp;
    }
  }
  else{
    if ($items[$j - 1][$attr] < $items[$j][$attr]) {
        $temp = $items[$j - 1];
        $items[$j - 1] = $items[$j];
        $items[$j] = $temp;
    }
  }
  }
}
return $items;
}

public function getUnreadMessage($roomId,$userId){
  $unread_mssg=[];
  $esta=[];
  $user_unread_mssg=[];
  $messages=ChatMessage::where('room_id',$roomId)
                       ->where('read',0)
                       ->where('to_user_id',auth()->user()->id)
                       ->orderBy('created_at','DESC')
                       ->get();
  for($i=0;$i<count($messages);$i++){
      if($messages[$i]->user_id==$userId){
        $messages[$i]->read=1;
        $messages[$i]->update();
      }
      else{
      $user=$this->getUserById($messages[$i]->user_id);
      if(!in_array($user,$user_unread_mssg)){
       $user_unread_mssg[]=$user;
      }
      $unread_mssg[]=$messages[$i];
      }
  }
                       return ['mssg'=>$unread_mssg,'user_unread'=>$user_unread_mssg,'esta'=>$esta];
}

  public function newMessage(Request $request, $roomId){
    $date=Carbon::now();
    $new_message=new ChatMessage();
    $new_message->user_id=Auth::id();
    $new_message->room_id=$roomId;
    $new_message->message=$request->message;
    $new_message->to_user_id=$request->user;
    $new_message->type_id=4;
    $new_message->date=$date;
    $new_message->save();

    broadcast(new NewChatMessage($new_message,auth()->user()))->toOthers();
    return $new_message;

  }
}
