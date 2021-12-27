<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\Role;
use App\Models\User;
use App\Models\ArticleComment;
use App\Notifications\ArticleNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Cache;
use App\Events\EventPublicArticle;



class ArticleController extends Controller
{
    public function index(){
        $roles = Role::all();
        $currentPage = request('page');
        $articles = Cache::rememberForever('articles:paginate(5)'.$currentPage, function(){
            return Articles::paginate(5);
        });
        return response()->json($articles);
        // return view('articles.index',['articles'=> $articles, 'roles' => $roles]);
    }

    public function create(){
        $this->authorize('create', [self::class]);
            return view('articles.create');
    }

    public function store($id=null, Request $request){

       
        $request->validate([
            'name' => 'required',
            'date' => 'required'
        ]);

        if ($id == null) {
            $article = new Articles();
        }

        else $article = Articles::findOrFail($id);
        $article->name = request('name');
        $article->short_text = request('description');
        $article->data_create = request('date');
        $result = $article->save();
        Cache::forget('articles:paginate(5)');
        $user = User::where('id', '!=', auth()->user()->id)->get();
        event(new EventPublicArticle($article->id));
        Notification::send($user, new ArticleNotification(Articles::latest('id')->first()));
        return redirect('/articles/'.$article->id);
    }

    public function view($id){
        $article =  Articles::findOrFail($id);
        Cache::put('article:'.$id, $article);
        $comments = ArticleComment::where('article_id', $id)->where('accept', 1)->paginate(3);
        Cache::put('article:comment'.$id, $comments);
        

        return view('articles.view',['article'=>$article, 'comments'=>$comments]);
    }

    public function edit($id){
        $article = Articles::findOrFail($id);
        Cache::forget('articles:paginate(5)');
        Cache::forget('article:'.$id);
        return view('articles.update', ['article'=>$article]);
    }

    public function destroy($id){
        $article = Articles::findOrFail($id);
        ArticleComment::where('article_id', $article->id)->delete();
        $article->delete();
        Cache::forget('articles:paginate(5)');
        Cache::forget('article:'.$id);
        Cache::forget('article:comment'.$id);

        return redirect ('/articles');
    }
}


       