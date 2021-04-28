<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::group(['prefix'=>'admin'],function(){
Route::resource('/paket', App\Http\Controllers\PaketController::class,['except'=>['create','edit']])->middleware('role:administrator');
Route::get('/available-pakets', [App\Http\Controllers\PaketController::class, 'availablePakets']);
Route::get('/all-pakets', [App\Http\Controllers\PaketController::class, 'getAllPakets']);
Route::get('/get-translated-packet-by-lang/{lang}/{id_packet}/{content_type}',[App\Http\Controllers\PaketController::class, 'getTranslatedPackByLang']);
Route::post('/add-translate-packet', [App\Http\Controllers\PaketController::class, 'addTranslatePacket']);
Route::post('/packet-translated-edited/{id_packet}/{lang_name}',[App\Http\Controllers\PaketController::class, 'updateTranslatedPacketByLang']);
});
