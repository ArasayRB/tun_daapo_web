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
Route::get('/all-section-pages', [App\Http\Controllers\SectionPageController::class, 'getAllSectionPages']);
Route::post('/add-translate-section', [App\Http\Controllers\SectionPageController::class, 'addTranslate']);
Route::get('/get-translated-section-by-lang/{lang}/{id_post}/{content_type}',[App\Http\Controllers\SectionPageController::class, 'getTranslatedItemByLang']);
Route::post('/section-translated-edited/{id_post}/{lang_name}',[App\Http\Controllers\SectionPageController::class, 'updateTranslatedSectionByLang']);
