<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Mail;

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
//Public route
Route::post('/registration', [AuthController::class, 'registration']);
Route::post('/login', [AuthController::class, 'login'])->name('login');



//Private route
Route::middleware('auth:sanctum')->get('/signout', [AuthController::class, 'signOut']);
Route::middleware('auth:sanctum')->resource('article', ArticlesController::class);
Route::group(['prefix' => '/comment', 'middleware'=>'auth:sanctum'], function(){
    Route::get('', [ArticleCommentController::class, 'index'])->name('index');
    Route::get('/{id}/accept', [ArticleCommentController::class, 'accept']);
    Route::get('/{id}/delete', [ArticleCommentController::class, 'destroy']);
    Route::post('/{id}/create', [ArticleCommentController::class, 'store']);

});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
