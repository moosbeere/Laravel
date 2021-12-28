<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\AuthController;

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
//public routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/custom-registration', [AuthController::class, 'customRegistration']);

//private routes
Route::middleware('auth:sanctum')->resource('article', ArticleController::class);
Route::middleware('auth:sanctum')->get('/logout', [AuthController::class, 'signOut']);
Route::group(['prefix' => '/comment', 'middleware'=>'auth:sanctum'], function(){
        Route::get('', [ArticleCommentController::class, 'index'])->name('index');
        Route::get('/{id}/accept', [ArticleCommentController::class, 'accept']);
        Route::post('/{id}/create', [ArticleCommentController::class, 'store']);
        Route::get('/{id}/delete', [ArticleCommentController::class, 'destroy']);
    });


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
