<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::resource('/room-type-chat', App\Http\Controllers\ChatTypeRoomController::class,['except'=>['create','edit']])->middleware('role:administrator');
Route::get('/room-types-list', [App\Http\Controllers\ChatTypeRoomController::class, 'getChatRoomTypeList']);
Route::get('/all-room-types-chats', [App\Http\Controllers\ChatTypeRoomController::class, 'getAllRoomTypesChat']);
