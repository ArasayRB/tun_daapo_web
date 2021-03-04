<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::resource('/portfolio', App\Http\Controllers\PortfolioController::class,['except'=>['create','edit']])->middleware('role:administrator');
Route::get('/portfolioList', [App\Http\Controllers\PortfolioController::class, 'getPortfolioList']);
Route::get('/available-services', [App\Http\Controllers\PortfolioController::class, 'availableService']);
