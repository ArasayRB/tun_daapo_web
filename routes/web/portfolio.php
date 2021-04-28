<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::group(['prefix'=>'admin'],function(){
Route::resource('/portfolio', App\Http\Controllers\PortfolioController::class,['except'=>['create','edit']])->middleware('role:administrator');
Route::get('/portfolioList', [App\Http\Controllers\PortfolioController::class, 'getPortfolioList']);
Route::get('/available-services', [App\Http\Controllers\PortfolioController::class, 'availableService']);
Route::get('/all-portfolios', [App\Http\Controllers\PortfolioController::class, 'getAllPortfolios']);
Route::get('/get-translated-portfolio-by-lang/{lang}/{id_section}/{content_type}',[App\Http\Controllers\PortfolioController::class, 'getTranslatedPortfolioByLang']);
Route::post('/add-translate-portfolio', [App\Http\Controllers\PortfolioController::class, 'addTranslatePortfolio']);
Route::post('/portfolio-translated-edited/{id_section}/{lang_name}',[App\Http\Controllers\PortfolioController::class, 'updateTranslatedPortfolioByLang']);
});
