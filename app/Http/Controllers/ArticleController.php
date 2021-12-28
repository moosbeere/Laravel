<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\User;
use App\Models\ArticleComment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Cache;
use App\Notifications\ArticleNotification;
use App\Events\EventPublicArticle;


class ArticleController extends Controller
{
    public function index(){
        $currentPage = request('page');
        $aricles = Cache::rememberForever('articles all'.$currentPage, function (){
            return Articles::paginate(7);
        });

        return view('articles.index',['articles'=> $aricles]);
    }

    public function create(){
        Gate::authorize('create-article');
        return view('articles.create');
    }

    public function store($id = null){
        if ($id) $article = Articles::findOrFail($id);
        else  $article = new Articles();
            
            $article->name = request('name');
            $article->short_text = request('description');
            $article->data_create = request('date');
            $article->save();
            Cache::forget('articles all');
            Cache::forget('article'.$article->id);
            $user = User::where('id', '!=', auth()->user()->id)->get();
            Notification::send($user, new ArticleNotification($article));

            event(new EventPublicArticle($article->name));
            
        return redirect('/articles/'.$article->id);
    }

    public function view($id){
        $article = Cache::remember('article'. $id, 60, function(){
            return Articles::findOrFail($id);
        });
        $comments = Cache::remember('article comment'.$id, 60, function(){
            ArticleComment::where('article_id', $id)->where('accept', 1)->paginate(3);
        });
        return view('articles.view',['article'=>$article, 'comments' => $comments]);
    }

    public function update($id){
        Gate::authorize('update-article');

        $article = Articles::findOrFail($id);
        return view('articles.edit', ['article' => $article]);
    }

    public function destroy($id){
        Gate::authorize('delete-article');
        $article = Articles::findOrFail($id);
        ArticleComment::where('article_id', $article->id)->delete();
        $article->delete();
        Cache::forget('articles all');
        Cache::forget('article'.$article->id);
        Cache::forget('article comment'.$id);
        return redirect('/articles');

    }
}

