<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Mail;

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

Route::get('/', function () {
    $mail = new App\Mail\TestMail('Hello');
    Mail::send($mail);
    // return view('main');
});
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/create', [ArticleController::class, 'create']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);
Route::get('/articles/{id}/edit', [ArticleController::class, 'update']);
Route::post('/articles/{id}/edit', [ArticleController::class, 'store']);
Route::get('/articles/{id}/delete', [ArticleController::class, 'delete']);

Route::post('/articles/{id}/comment', [ArticleCommentController::class, 'store']);
Route::post('/articles', [ArticleController::class, 'store']);

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/registration', [AuthController::class, 'registration']);
Route::get('/signout', [AuthController::class, 'signOut']);
Route::post('/custom-registration', [AuthController::class, 'customRegistration']);
Route::post('/custom-login', [AuthController::class, 'customLogin']);
