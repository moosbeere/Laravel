<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ArticleCommentsController;
use App\Models\User;
use App\Events\EventPublicArticle;

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
Route::group(['prefix' => '/articles', 'middleware' => 'auth'], function () {
    Route::get('', [ArticleController::class,'index']);
    Route::get('/create', [ArticleController::class,'create'])->name('create');
    Route::get('/{id}', [ArticleController::class,'view'])->name('view');
    Route::get('/{id}/update', [ArticleController::class,'edit']);
    Route::get('/{id}/delete', [ArticleController::class,'destroy']);
    Route::post('/{id}/update', [ArticleController::class,'store']);
    Route::post('', [ArticleController::class, 'store']);
  });

Route::group(['prefix'=>'comment'], function(){
    Route::get('',[ArticleCommentsController::class, 'index'])->name('index');
    Route::get('/{id}/accept', [ArticleCommentsController::class, 'accept']);
    Route::get('/{id}/reject', [ArticleCommentsController::class, 'destroy']);
    Route::post('/{id}/create', [ArticleCommentsController::class, 'store']);
});


Route::get('/registration', [AuthController::class, 'index']);
Route::get('/auth/signin', [AuthController::class, 'login'])->name('login');
Route::get('/signout', [AuthController::class, 'signout']);
Route::post('/auth/registration', [AuthController::class, 'registration']);
Route::post('/auth/signin', [AuthController::class, 'customLogin']);
Route::post('articles/{id}/comment', [ArticleCommentsController::class, 'store']);



Route::get('/about', function () {
    $contact=[
        'adres'=>'Большая семеновская',
        'tel'=>'8(495)232-2323',
        'email'=>'@mospolitech.ru'
    ];

    return view('about',['contact' => $contact,]);
});

Route::get('/event', function(){
    event(new EventPublicArticle('bla'));
});

Route::get('/listen', function(){
        return view('listen');
});

?>
