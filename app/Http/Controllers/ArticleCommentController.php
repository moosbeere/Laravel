<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\ArticleComment;

class ArticleCommentController extends Controller
{
    public function store($id){
        $article = Articles::find($id);
        if ($article){
            $comment_title = request('comment-title');
            $comment = request('comment');
            if ($comment_title && $comment){
                $new_comment = new ArticleComment();
                $new_comment->title = $comment_title;
                $new_comment->comment = $comment;
                $new_comment->article()->associate($article);
                $new_comment->save();
                return redirect('articles/'.$article->id);
            }
        }
    }
}
