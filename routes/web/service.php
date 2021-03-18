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
Route::get('/available-services', [App\Http\Controllers\ServiceController::class, 'availableServices']);
Route::post('/add-translate-service', [App\Http\Controllers\ServiceController::class, 'addTranslateService']);
Route::post('/service-translated-edited/{id_service}/{lang_name}',[App\Http\Controllers\ServiceController::class, 'updateTranslatedServByLang']);
Route::get('/all-services', [App\Http\Controllers\ServiceController::class, 'getAllServices']);
Route::get('/get-translated-service-by-lang/{lang}/{id_service}/{content_type}',[App\Http\Controllers\ServiceController::class, 'getTranslatedServiceByLang']);
