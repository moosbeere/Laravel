<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\ArticleComment;
use App\Jobs\VeryLongJob;

class ArticleCommentController extends Controller
{

    public function index(){
        $comments = ArticleComment::orderBy('accept', 'asc')->get();
        foreach($comments as $comment){
            $article[] = Articles::findOrFail($comment->article_id);
        }
        return view('comment.index', ['comments' => $comments, 'article' => $article]);
    }

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
                $result = $new_comment->save();
                if ($result){
                    VeryLongJob::dispatch($article);
                }
                return redirect()->route('show', ['id' => $article->id, 'result' => $result]);
            }
        }
    }

    public function accept($id){
        $comment = ArticleComment::findOrFail($id);
        $comment->accept = 1;
        $comment->save();
        return redirect()->route('index');
    }

    public function destroy($id){
        ArticleComment::findOrFail($id)->delete();
        return redirect()->route('index');
    }
}
