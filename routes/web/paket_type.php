<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::resource('/pakettypes', App\Http\Controllers\PaketTypeController::class,['except'=>['create','edit']])->middleware('role:administrator');
Route::get('/available-type-pakets', [App\Http\Controllers\PaketTypeController::class, 'availablePaketTypes']);
Route::get('/packet-type-list', [App\Http\Controllers\PaketTypeController::class, 'typePaketTypes']);
