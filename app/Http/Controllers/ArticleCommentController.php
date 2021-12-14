<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticleComment;
use App\Models\Articles;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class ArticleCommentController extends Controller
{

    public function index(){
        $comments = ArticleComment::orderBy('accept', 'asc')->get();
        foreach($comments as $comment){
            $article[] = Articles::find($comment->article_id);
        }
        return view('comment.index', ['comments' => $comments, 'article' => $article]);
    }

    public function accept($id){
        $comment = ArticleComment::findOrFail($id);
        $comment->accept = 1;
        $comment->save();
        return redirect()->route('index');
    }
    public function store(){

        $article_id = request('article_id');
        if($article_id){
            $article = Articles::find($article_id);
            if($article){
                $comment_title = request('comment_title');
                $comment = request('comment');
                if($comment && $comment_title){
                    $new_comment = new \App\Models\ArticleComment();
                    $new_comment->title = $comment_title;
                    $new_comment->comment = $comment;
                    $new_comment->article()->associate($article);
                    $result = $new_comment->save();
                    if ($result){
                        $testMail = new TestMail('Для статьи'.$article->name.'создан новый комментарий. Ожидает модерации.');
                        Mail::send($testMail);
                    }
                    return redirect()->route('view', ['id' => $article->id, 'result' => $result]);
                }else{
                    return ;
                }
            }else{
                return ;
            }
        }else{
            return ;
        }
     
    }

    public function destroy($id){
        ArticleComment::findOrFail($id)->delete();
        return redirect()->route('index');
    }
}
