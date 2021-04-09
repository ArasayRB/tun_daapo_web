<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::get('/chat/rooms', [App\Http\Controllers\ChatController::class, 'rooms']);
Route::get('/chat/room/{roomId}/messages', [App\Http\Controllers\ChatController::class, 'messages']);
Route::post('/chat/room/{roomId}/message', [App\Http\Controllers\ChatController::class, 'newMessage']);
Route::get('/chat/room/{roomId}/{userId}/user/message', [App\Http\Controllers\ChatController::class, 'getUserMessage']);
Route::get('/chat/room/{roomId}/{userId}/unread-messages', [App\Http\Controllers\ChatController::class, 'getUnreadMessage']);
