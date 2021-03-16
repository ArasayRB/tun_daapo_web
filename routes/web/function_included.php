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
Route::get('/get-translated-function-by-lang/{lang}/{id_funct}/{content_type}',[App\Http\Controllers\FunctionIncludedController::class, 'getTranslatedFunctionByLang']);
Route::post('/add-translate-function', [App\Http\Controllers\FunctionIncludedController::class, 'addTranslate']);
Route::post('/function-translated-edited/{id_section}/{lang_name}',[App\Http\Controllers\FunctionIncludedController::class, 'updateTranslatedFunctionByLang']);
