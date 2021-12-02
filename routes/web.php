<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\AuthController;

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
Route::get('/', function(){
    return view('main');
});

Route::get('/articles', [ArticleController::class,'index']);
Route::get('/about', [ArticleController::class,'contact']);
Route::get('/articles/create', [ArticleController::class, 'create']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);
Route::get('/articles/{id}/edit', [ArticleController::class, 'update']);
Route::get('/articles/{id}/delete', [ArticleController::class, 'destroy']);
Route::post('/articles/{id}/edit', [ArticleController::class, 'store']);


Route::post('/articles/{id}/comments', [ArticleCommentController::class, 'store']);
Route::post('/articles', [ArticleController::class, 'store']);

Route::get('/registration', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'signOut']);
Route::post('/custom-registration', [AuthController::class, 'customRegistration']);
Route::post('/custom-login', [AuthController::class, 'customLogin']);
