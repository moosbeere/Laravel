<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleCommentController extends Controller
{
    public function store(){

        $article_id = request('article_id');
        if($article_id){
            $article = \App\Models\Articles::find($article_id);
            if($article){
                $comment_title = request('comment_title');
                $comment = request('comment');
                if($comment && $comment_title){
                    $new_comment = new \App\Models\ArticleComment();
                    $new_comment->title = $comment_title;
                    $new_comment->comment = $comment;
                    $new_comment->article()->associate($article);
                    $new_comment->save();
     
                    return redirect('/articles/'.$article->id);
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
}
