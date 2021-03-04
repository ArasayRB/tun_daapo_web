<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::resource('/paket', App\Http\Controllers\PaketController::class,['except'=>['create','edit']])->middleware('role:administrator');
Route::get('/paketList', [App\Http\Controllers\PaketController::class, 'getPaketList']);
Route::get('/available-pakets', [App\Http\Controllers\PaketController::class, 'availablePakets']);
