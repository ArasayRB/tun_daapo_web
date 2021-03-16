<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::resource('/functions-included', App\Http\Controllers\FunctionIncludedController::class,['except'=>['create','edit']])->middleware('role:administrator');
Route::get('/available-functions', [App\Http\Controllers\FunctionIncludedController::class, 'availableFunctions']);
Route::get('/functions-included-list', [App\Http\Controllers\FunctionIncludedController::class, 'functionsIncludedList']);
Route::get('/all-functions-included', [App\Http\Controllers\FunctionIncludedController::class, 'getAllFunctionsIncluded']);