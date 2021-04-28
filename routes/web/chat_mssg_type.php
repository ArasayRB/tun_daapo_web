<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::group(['prefix'=>'admin'],function(){
Route::resource('/mssg-type-chat', App\Http\Controllers\ChatTypeMessageController::class,['except'=>['create','edit']])->middleware('role:administrator');
Route::get('/mssg-types-list', [App\Http\Controllers\ChatTypeMessageController::class, 'getChatMessageTypeList']);
Route::get('/all-mssg-types-chats', [App\Http\Controllers\ChatTypeMessageController::class, 'getAllMessageTypesChat']);
});
