<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Articles;
use App\Http\Controllers\AuthController;    
use App\Http\Controllers\ArticleController;    
use App\Http\Controllers\ArticleCommentsController;    
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Private routes
Route::get('/signout', [AuthController::class, 'signout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->resource('articles', ArticleController::class);

Route::group(['prefix'=>'comment', 'middleware' => 'auth:sanctum'], function(){
    Route::get('',[ArticleCommentsController::class, 'index'])->name('index');
    Route::get('/{id}/accept', [ArticleCommentsController::class, 'accept']);
    Route::delete('/{id}', [ArticleCommentsController::class, 'destroy']);
    Route::post('/{id}', [ArticleCommentsController::class, 'store']);
});

//public routes
Route::get('/registration', [AuthController::class, 'index']);
Route::get('/auth/signin', [AuthController::class, 'login'])->name('login');

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
