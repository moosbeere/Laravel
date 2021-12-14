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
Route::group(['prefix'=>'/articles', 'middleware'=>'auth'], function(){
    Route::get('', [ArticleController::class,'index']);
    Route::get('/create', [ArticleController::class, 'create']);
    Route::get('/{id}', [ArticleController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ArticleController::class, 'update']);
    Route::get('/{id}/delete', [ArticleController::class, 'destroy']);
    Route::post('/{id}/edit', [ArticleController::class, 'store']);
    Route::post('', [ArticleController::class, 'store']);
});

Route::group(['prefix' => '/comment', 'middleware'=>'auth'], function(){
    Route::get('', [ArticleCommentController::class, 'index'])->name('index');
    Route::get('/{id}/accept', [ArticleCommentController::class, 'accept']);
    Route::post('/{id}/create', [ArticleCommentController::class, 'store']);
    Route::get('/{id}/delete', [ArticleCommentController::class, 'destroy']);
});

Route::get('/about', [ArticleController::class,'contact']);
Route::get('/registration', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'signOut']);
Route::post('/custom-registration', [AuthController::class, 'customRegistration']);
Route::post('/custom-login', [AuthController::class, 'customLogin']);
