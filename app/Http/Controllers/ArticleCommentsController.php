<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\ArticleComment;

class ArticleCommentsController extends Controller
{
    public function index(){
        $comment = ArticleComment::all();
        foreach($comment as $one_comment){
            $article = Articles::find($one_comment->article_id);
        }
        return view('comment.index', ['comment' => $comment, 'article' => $article]);
    }
    public function store($id){
        $article = Articles::find($id);
        if ($article){
            $comment_title = request('comment_title');
            $comment = request('comment');
            if ($comment && $comment_title){
                $new_comment = new ArticleComment();
                $new_comment->title = $comment_title;
                $new_comment->comment = $comment;
                $new_comment->article()->associate($article);
                $new_comment->save();
                return redirect('articles/'.$id);
            }
        }
    }
}
