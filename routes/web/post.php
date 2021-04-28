<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

Route::group(['prefix'=>'admin'],function(){
Route::post('/publicate-post/{id}/{state}', [App\Http\Controllers\PostController::class, 'publicatePost']);
Route::resource('/posts', App\Http\Controllers\PostController::class)->middleware('role:administrator,viewer-content,writer-content,publisher-content');
Route::get('/categoriesList', [App\Http\Controllers\PostController::class, 'getCategories']);
Route::get('/postsTable', [App\Http\Controllers\PostController::class, 'getPostAutentUser']);
Route::get('/available-tags', [App\Http\Controllers\PostController::class, 'getTagsExisting']);
Route::get('/available-keys', [App\Http\Controllers\PostController::class, 'availableKeys']);
Route::post('/addTranslate',[App\Http\Controllers\PostController::class, 'addTranslatePost']);
Route::get('/translated-post/{id}',[App\Http\Controllers\PostController::class, 'getTranslatedPostById']);
Route::get('/get-translated-post-by-lang/{lang}/{id_post}/{content_type}',[App\Http\Controllers\PostController::class, 'getTranslatedPostByLang']);
Route::post('/posts-translated-edited/{id_post}/{lang_name}',[App\Http\Controllers\PostController::class, 'updateTranslatedPostByLang']);
Route::get('/all-posts', [App\Http\Controllers\PostController::class, 'getAllPosts']);
Route::get('/all-categories', [App\Http\Controllers\CategoriaPostController::class, 'getAllCategories']);
Route::resource('/category', App\Http\Controllers\CategoriaPostController::class,['except'=>['create','edit']])->middleware('role:administrator,editor-content');
Route::get('/all-comments-config', [App\Http\Controllers\ConfigComentarioPostController::class, 'getAllCommentConfig']);
Route::get('config-comments-list', [App\Http\Controllers\ConfigComentarioPostController::class, 'getCommentsConfig']);
Route::resource('/configuration-comments', App\Http\Controllers\ConfigComentarioPostController::class,['except'=>['create','edit']])->middleware('role:administrator,editor-content');
Route::get('/all-comments', [App\Http\Controllers\ComentarioPostController::class, 'getAllComments']);
Route::get('comments-list', [App\Http\Controllers\ComentarioPostController::class, 'getComments']);
Route::resource('/comments-post', App\Http\Controllers\ComentarioPostController::class,['except'=>['create','edit']])->middleware('role:administrator,editor-content,moderator');
Route::post('/publicate-comment/{id}/{state}', [App\Http\Controllers\ComentarioPostController::class, 'publicateComment']);
Route::get('/posts-list-form', [App\Http\Controllers\ComentarioPostController::class, 'getPosts']);

});
