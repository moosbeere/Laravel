<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentPage = request()->get('page',1);
        $articles = Cache::remember('articles:all'.$currentPage, 2000, function(){
            return Articles::paginate(7);
        });
       return response()->json([
           'articles' => $articles,
       ]);
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
            $article = new Articles();
            $article->name = request('name');
            $article->short_text = request('description');
            $article->data_create = request('date');
            $article->save();
            Cache::forget('articles:all');
            $user = User::where('id', '!=', auth()->user()->id)->get();
            Notification::send($user, new NewArticleNotification($article));
            
            event(new EventNewArticle($article));
            
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
        $article = Cache::rememberForever('article:'.$id, function()use($id){
            return Articles::findOrFail($id);
        });
        $comment = Cache::rememberForever('article:comment:'.$id, function()use($id){
            return ArticleComment::where('article_id', $id)->where('accept', 1)->paginate(3);
        });
        return response()->Json([
            'article' => $article,
            'comment' => $comment
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
        Gate::authorize('update-article');
        $article = Articles::findOrFail($id);
        Cache::forget('articles:all');
        Cache::forget('article:'.$id);
        return response([
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
            $article = Articles::findOrFail($id);
            $article->name = request('name');
            $article->short_text = request('description');
            $article->data_create = request('date');
            $article->save();
            Cache::forget('articles:all');
            $user = User::where('id', '!=', auth()->user()->id)->get();
            Notification::send($user, new NewArticleNotification($article));
            
            event(new EventNewArticle($article));
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
        Gate::authorize('delete-article');
        Cache::forget('articles:all');
        Cache::forget('article:'.$id);
        Cache::forget('article:comment:'.$id);
        return response(Articles::findOrFail($id)->delete());

    }
}
