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
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'welcome'])->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/questions-frequently', [App\Http\Controllers\WelcomeController::class, 'questionsFrequently'])->name('questions');
Route::get('/terms-conditions', [App\Http\Controllers\WelcomeController::class, 'termConditions'])->name('terms_conditions');
Route::get('/cookies-accepted', [App\Http\Controllers\WelcomeController::class, 'cookiesAccepted'])->name('cookies_accepted');
Route::get('/is-cookies-accepted', [App\Http\Controllers\WelcomeController::class, 'isCookiesAccepted'])->name('is_cookies_accepted');
Route::get('/privacy-policy', [App\Http\Controllers\WelcomeController::class, 'policyPrivacy'])->name('privacy_policy');
Route::get('language/{language}', [App\Http\Controllers\WelcomeController::class, 'switchLang'])->name('language.select');
Route::get('/section_name/{name}', [App\Http\Controllers\WelcomeController::class, 'getSectionItem']);
Route::get('/services_offer', [App\Http\Controllers\WelcomeController::class, 'getServicesInOffer']);
Route::get('/tun-daapo-portfolio', [App\Http\Controllers\WelcomeController::class, 'getPortfolioView']);
Route::get('/post-list/{id}', [App\Http\Controllers\WelcomeController::class, 'showPost'])->name('post-list');
Route::get('/posts-list', [App\Http\Controllers\WelcomeController::class, 'getPostsList']);
Route::post('/share/{id}/{media}', [App\Http\Controllers\WelcomeController::class, 'sharePostMedia']);
Route::post('/post-love/{id}', [App\Http\Controllers\WelcomeController::class, 'addLove']);
Route::get('/tun-daapo-contact', [App\Http\Controllers\WelcomeController::class, 'getContact'])->name('data-hostal');
Route::get('/paketList', [App\Http\Controllers\WelcomeController::class, 'getPaketList']);
Route::post('/ask-budget', [App\Http\Controllers\AskBudgetController::class, 'store']);
Route::post('/suscripcion', [App\Http\Controllers\SuscriptionController::class, 'store']);
Route::get('/translated-language-item/{id}/{contentType}',[App\Http\Controllers\HomeController::class, 'hasTranslate']);
Route::get('/languages-no-translated/{id_item}/{content}',[App\Http\Controllers\HomeController::class, 'getNoTransLangItem']);
Route::get('/unsubscribe/{suscriptor}', [App\Http\Controllers\SuscriptionController::class, 'delete'])->middleware(['guest'])->name('unsubscribe');
Route::post('/leave-comment', [App\Http\Controllers\WelcomeController::class, 'makeComment']);
Route::get('/comments-post/{post_id}', [App\Http\Controllers\WelcomeController::class, 'getComentsByPost']);
Route::post('/leave-comment-reply', [App\Http\Controllers\WelcomeController::class, 'replyComment']);
Route::get('/comments-post-answare/{post_id}/{comment_id}', [App\Http\Controllers\WelcomeController::class, 'getComentsReplyByPost']);
Route::get('/config-comments', [App\Http\Controllers\WelcomeController::class, 'getConfigComment']);
