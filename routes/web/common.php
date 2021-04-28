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



Route::redirect('/','/en');
Route::redirect('/home','/en/home');
Route::redirect('/login','/en/login');
Route::get('/blog/{slug}', [App\Http\Controllers\WelcomeController::class, 'showPost'])->name('blog');
Route::get('/post-preview/{id}', [App\Http\Controllers\PostController::class, 'previewPost'])->name('post-preview');
Route::post('/share/{id}/{media}', [App\Http\Controllers\WelcomeController::class, 'sharePostMedia']);
Route::post('/post-love/{id}', [App\Http\Controllers\WelcomeController::class, 'addLove']);
Route::get('/comments-post/{post_id}', [App\Http\Controllers\WelcomeController::class, 'getComentsByPost']);
Route::post('/leave-comment', [App\Http\Controllers\WelcomeController::class, 'makeComment']);
Route::post('/leave-comment-reply', [App\Http\Controllers\WelcomeController::class, 'replyComment']);
Route::get('/comments-post-answare/{post_id}/{comment_id}', [App\Http\Controllers\WelcomeController::class, 'getComentsReplyByPost']);
Route::get('/config-comments', [App\Http\Controllers\WelcomeController::class, 'getConfigComment']);
Route::get('/is-cookies-accepted', [App\Http\Controllers\WelcomeController::class, 'isCookiesAccepted'])->name('is_cookies_accepted');
Route::post('/ask-budget', [App\Http\Controllers\AskBudgetController::class, 'store']);
Route::post('/suscripcion', [App\Http\Controllers\SuscriptionController::class, 'store']);
Route::get('/unsubscribe/{suscriptor}', [App\Http\Controllers\SuscriptionController::class, 'delete'])->middleware(['guest'])->name('unsubscribe');
