<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleCommentsController;


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
    return view('main');
});
Route::get('/articles', [ArticleController::class,'index']);
Route::get('/articles/create', [ArticleController::class,'create']);
Route::get('/articles/{id}', [ArticleController::class,'view']);
Route::post('/articles', [ArticleController::class, 'store']);
Route::post('articles/{id}/comment', [ArticleCommentsController::class, 'store']);

Route::get('/about', function () {
    $contact=[
        'adres'=>'Большая семеновская',
        'tel'=>'8(495)232-2323',
        'email'=>'@mospolitech.ru'
    ];

    return view('about',['contact' => $contact]);
});