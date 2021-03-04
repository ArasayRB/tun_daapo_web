<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


Route::resource('/sectionpage', App\Http\Controllers\SectionPageController::class,['except'=>['create','edit']])->middleware('role:administrator');
Route::get('/sectionpageList', [App\Http\Controllers\SectionPageController::class, 'getSectionPageList']);
