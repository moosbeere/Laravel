<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
<<<<<<< HEAD
use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Mail;
=======
use App\Http\Controllers\ArticleCommentsController;
>>>>>>> comment: controller


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
    $testMail = new App\Mail\TestMail('hello');
    Mail::send($testMail);
    // return view('main');+
});
<<<<<<< HEAD

=======
>>>>>>> changed views & routes & controllers (refactor from valentin)
Route::get('/articles', [ArticleController::class,'index']);
Route::get('/articles/create', [ArticleController::class,'create']);
Route::get('/articles/{id}', [ArticleController::class,'view']);
Route::post('/articles', [ArticleController::class, 'store']);
<<<<<<< HEAD
<<<<<<< HEAD
Route::post('/article-comments', [ArticleCommentController::class, 'store']);


Route::get('/registration', [AuthController::class, 'index']);
Route::get('/auth/signin', [AuthController::class, 'login']);
Route::get('/signout', [AuthController::class, 'signout']);
Route::post('/auth/registration', [AuthController::class, 'registration']);
Route::post('/auth/signin', [AuthController::class, 'customLogin']);
=======
>>>>>>> changed views & routes & controllers (refactor from valentin)
=======
Route::post('articles/{id}/comment', [ArticleCommentsController::class, 'store']);

<<<<<<< HEAD
// Route::post('articles/{id}/comment', function ($id){
//     $article = App\Models\Articles::find($id);
//     if ($article){
//         $comment_title = request('comment_title');
//         $comment = request('comment');
//         if ($comment && $comment_title){
//             $new_comment = new App\Models\ArticleComment();
//             $new_comment->title = $comment_title;
//             $new_comment->comment = $comment;
//             $new_comment->article()->associate($article);
//             $new_comment->save();
//             return redirect('articles/'.$id);
//         }
//     }
// });
>>>>>>> comment: controller

=======
>>>>>>> change route
Route::get('/about', function () {
    $contact=[
        'adres'=>'Большая семеновская',
        'tel'=>'8(495)232-2323',
        'email'=>'@mospolitech.ru'
    ];

    return view('about',['contact' => $contact]);
<<<<<<< HEAD
});
=======
});
>>>>>>> changed views & routes & controllers (refactor from valentin)
