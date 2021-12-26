<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Articles;
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

Route::get('/products', function(){
    return Articles::all();
});

Route::post('/auth/registration', [AuthController::class, 'registration']);
Route::post('/auth/signin', [AuthController::class, 'customLogin'])->name('login');


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
