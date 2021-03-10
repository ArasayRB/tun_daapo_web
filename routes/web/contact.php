<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::resource('/contact', App\Http\Controllers\ContactController::class,['except'=>['create','edit']])->middleware('role:administrator');
Route::get('/contactList', [App\Http\Controllers\ContactController::class, 'getContactList']);
Route::get('/all-contacts', [App\Http\Controllers\ContactController::class, 'getAllContacts']);
