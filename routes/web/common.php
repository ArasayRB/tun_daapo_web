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
Route::get('/', function () {
    return view('welcome_tun_daapo');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/section_name/{name}', [App\Http\Controllers\WelcomeController::class, 'getSectionItem']);
Route::get('/services_offer', [App\Http\Controllers\WelcomeController::class, 'getServicesInOffer']);
Route::get('/tun-daapo-portfolio', [App\Http\Controllers\WelcomeController::class, 'getPortfolioView']);
