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
Route::get('/get-translated-contact-by-lang/{lang}/{id_section}/{content_type}',[App\Http\Controllers\ContactController::class, 'getTranslatedContactByLang']);
Route::post('/add-translate-contact', [App\Http\Controllers\ContactController::class, 'addTranslateContact']);
Route::post('/contact-translated-edited/{id_section}/{lang_name}',[App\Http\Controllers\ContactController::class, 'updateTranslatedContactByLang']);
