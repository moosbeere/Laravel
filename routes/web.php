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
    // $testMail = new App\Mail\TestMail('hello');
    // Mail::send($testMail);
    return view('main');
});

Route::group(['prefix' => '/articles','middleware' => 'auth'], function(){
    Route::get('', [ArticleController::class,'index']);
    Route::get('/create', [ArticleController::class,'create']);
    Route::get('/{id}', [ArticleController::class,'view'])->name('view');
    Route::get('/{id}/edit', [ArticleController::class,'update']);
    Route::get('/{id}/delete', [ArticleController::class,'destroy']);

    Route::post('/{id}/edit', [ArticleController::class,'store']);
    Route::post('', [ArticleController::class, 'store']);
});

Route::group(['prefix' => '/comment'], function(){
    Route::get('', [ArticleCommentController::class, 'index'])->name('index');
    Route::post('/create', [ArticleCommentController::class, 'store']);
    Route::get('/{id}/accept', [ArticleCommentController::class, 'accept']);
    Route::get('/{id}/delete', [ArticleCommentController::class, 'destroy']);
});


Route::get('/registration', [AuthController::class, 'index']);
Route::get('/auth/signin', [AuthController::class, 'login'])->name('login');
Route::get('/signout', [AuthController::class, 'signout']);
Route::post('/auth/registration', [AuthController::class, 'registration']);
Route::post('/auth/signin', [AuthController::class, 'customLogin']);

Route::get('/about', function () {
    $contact=[
        'adres'=>'Большая семеновская',
        'tel'=>'8(495)232-2323',
        'email'=>'@mospolitech.ru'
    ];

    return view('about',['contact' => $contact]);
});
