<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::resource('/service', App\Http\Controllers\ServiceController::class,['except'=>['create','edit']])->middleware('role:administrator');
Route::get('/serviceList', [App\Http\Controllers\ServiceController::class, 'getServiceList']);
