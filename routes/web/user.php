<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::group(['prefix'=>'admin'],function(){
Route::get('/usersList', [App\Http\Controllers\UserController::class, 'getUsersList']);
Route::get('/available-users',[App\Http\Controllers\UserController::class, 'users']);
Route::resource('/users', App\Http\Controllers\UserController::class)->middleware('can:admin');
Route::get('/roles-list',[App\Http\Controllers\UserController::class, 'allRoles']);
Route::get('/permission',[App\Http\Controllers\UserController::class, 'checkPermission']);
Route::get('/all-users', [App\Http\Controllers\UserController::class, 'getAllUsers']);
});
