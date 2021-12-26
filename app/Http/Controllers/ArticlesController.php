<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\ArticleComment;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewArticleNotification;
use App\Events\EventNewArticle;

class ArticlesController extends Controller
{
    public function index(){
        $currentPage = request()->get('page',1);
        $articles = Cache::rememberForever('articles:all'.$currentPage, function(){
            return Articles::paginate(7);
        });
       return view('articles.index', ['articles' => $articles]);
    }

    public function create(){
        $this->authorize('create', [self::class]);
        return view('articles.create');
    }

    public function show($id){
        $article = Cache::rememberForever('article:'.$id, function()use($id){
            return Articles::findOrFail($id);
        });
        $comment = Cache::rememberForever('article:comment:'.$id, function()use($id){
            return ArticleComment::where('article_id', $id)->where('accept', 1)->paginate(3);
        });
        return view('articles.view', ['article' => $article, 'comments'=>$comment]);
    }

    public function store($id = null){
        if ($id == null) $article = new Articles();
        else $article = Articles::findOrFail($id);
            $article->name = request('name');
            $article->short_text = request('description');
            $article->data_create = request('date');
            $article->save();
            Cache::forget('articles:all');
            $user = User::where('id', '!=', auth()->user()->id)->get();
            Notification::send($user, new NewArticleNotification($article));
            
            event(new EventNewArticle($article));
            
        return redirect('/articles/'.$article->id);
    }

    public function update($id){
        Gate::authorize('update-article');
        $article = Articles::findOrFail($id);
        Cache::forget('articles:all');
        Cache::forget('article:'.$id);
        return view('articles.edit', ['article' => $article]);
    }

    public function delete($id){

        Gate::authorize('delete-article');
        Articles::findOrFail($id)->delete();
        Cache::forget('articles:all');
        Cache::forget('article:'.$id);
        Cache::forget('article:comment:'.$id);
        return redirect('/articles');
    }
}

