<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::resource('/room-chat', App\Http\Controllers\ChatRoomController::class,['except'=>['create','edit']])->middleware('role:administrator');
Route::get('/room-chat-list', [App\Http\Controllers\ChatRoomController::class, 'getChatRoomList']);
Route::get('/all-room-chats', [App\Http\Controllers\ChatRoomController::class, 'getAllRoomsChat']);