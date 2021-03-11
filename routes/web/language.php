<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/languages', App\Http\Controllers\LanguageController::class,['except'=>['create','edit']]);
Route::get('language/{language}', [App\Http\Controllers\LanguageController::class, 'switchLang'])->name('language.select');
Route::get('/languagesList',[App\Http\Controllers\LanguageController::class, 'getLanguagesList']);
Route::get('/all-languages', [App\Http\Controllers\LanguageController::class, 'getAllLanguages']);
