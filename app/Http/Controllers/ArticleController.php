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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $currentPage = request('page');
        $articles = Cache::rememberForever('articles:paginate(5)'.$currentPage, function(){
            return Articles::paginate(5);
        });
        return response()->json($articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response($this->authorize('create', [self::class]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
            $request->validate([
                'name' => 'required',
                'data_create' => 'required'
            ]);
            $article = new Articles();
            $article->name = request('name');
            $article->short_text = request('short_text');
            $article->data_create = request('data_create');
            $result = $article->save();
            Cache::forget('articles:paginate(5)');
            $user = User::where('id', '!=', auth()->user()->id)->get();
            event(new EventPublicArticle($article->id));
            Notification::send($user, new ArticleNotification(Articles::latest('id')->first()));
            return response()->json([
                'article' => $article
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article =  Articles::findOrFail($id);
        Cache::put('article:'.$id, $article);
        $comments = ArticleComment::where('article_id', $id)->where('accept', 1)->paginate(3);
        Cache::put('article:comment'.$id, $comments);
        
        return response()->json([
            'article' => $article,
            'comments' => $comments
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Articles::findOrFail($id);
        return response()->json([
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $request->validate([
                'name' => 'required',
            ]);
            $article = Articles::findOrFail($id);
            $article->name = request('name');
            $article->short_text = request('short_text');
            $article->data_create = request('data_create');
            $article->save();
            Cache::forget('articles:paginate(5)');
            Cache::forget('article:'.$id);
            return response()->json([
                'article' => $article
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Articles::findOrFail($id);
        ArticleComment::where('article_id', $article->id)->delete();
        Cache::forget('articles:paginate(5)');
        Cache::forget('article:'.$id);
        Cache::forget('article:comment'.$id);

        return response($article->delete());
    }
}
