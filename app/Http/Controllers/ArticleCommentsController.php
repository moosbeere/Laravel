<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\ArticleComment;
use App\Jobs\VeryLongJob;

class ArticleCommentsController extends Controller
{
    public function index(){
        $comment = ArticleComment::orderBy('accept','asc')->get();
        foreach($comment as $one_comment){
            $article[] = Articles::find($one_comment->article_id);
        }
        return response()->json([
            'comment' => $comment,
            'article' => $article
        ]);
        // return view('comment.index', ['comment' => $comment, 'article' => $article]);
    }

    public function accept($id){
        $comment = ArticleComment::findOrFail($id);
        $comment->accept = 1;
        $comment->save();
        return response()->json([
            'comment' => $comment
        ]);
        // return redirect()->route('index');
    }

    public function destroy($id){
        return response(ArticleComment::findOrFail($id)->delete());
    }

    public function store($id){
        $article = Articles::find($id);
        if ($article){
            $comment_title = request('title');
            $comment = request('comment');
            if ($comment && $comment_title){
                $new_comment = new ArticleComment();
                $new_comment->title = $comment_title;
                $new_comment->comment = $comment;
                $new_comment->article()->associate($article);
                $result = $new_comment->save();
                VeryLongJob::dispatch($article);
                return response()->json([
                    'comment' => $new_comment,
                    'result' => $result
                ]);
                // return redirect()->route('view', ['id' => $article->id, 'result' => $result]);                
            }
        }
    }
}
