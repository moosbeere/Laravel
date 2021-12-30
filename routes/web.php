<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
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

// Route::get('/', function () {
//     // $mail = new App\Mail\TestMail('Hello');
//     // Mail::send($mail);
//     return view('main');
// });

// Route::group(['prefix'=>'/articles', 'middleware'=>'auth'], function(){
//     Route::get('', [ArticlesController::class, 'index']);
//     Route::get('/create', [ArticlesController::class, 'create']);
//     Route::get('/{id}', [ArticlesController::class, 'show'])->name('show');
//     Route::get('/{id}/edit', [ArticlesController::class, 'update']);
//     Route::post('/{id}/edit', [ArticlesController::class, 'store']);
//     Route::get('/{id}/delete', [ArticlesController::class, 'delete']);
//     Route::post('', [ArticlesController::class, 'store']);
// });

// Route::group(['prefix' => '/comment', 'middleware'=>'auth'], function(){
//     Route::get('', [ArticleCommentController::class, 'index'])->name('index');
//     Route::get('/{id}/accept', [ArticleCommentController::class, 'accept']);
//     Route::get('/{id}/delete', [ArticleCommentController::class, 'destroy']);
//     Route::post('/{id}/create', [ArticleCommentController::class, 'store']);

// });


// Route::get('/login', [AuthController::class, 'index'])->name('login');
// Route::get('/registration', [AuthController::class, 'registration']);
// Route::get('/signout', [AuthController::class, 'signOut']);
// Route::post('/custom-registration', [AuthController::class, 'customRegistration']);
// Route::post('/custom-login', [AuthController::class, 'customLogin']);
