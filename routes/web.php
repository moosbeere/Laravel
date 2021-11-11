<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

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

Route::get('/articles/{id}', [ArticleController::class, 'show']);
Route::get('/articles/create', [ArticleController::class, 'create']);


Route::post('/articles', [ArticleController::class, 'store']);