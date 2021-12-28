<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\User;
use App\Models\ArticleComment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ArticleNotification;
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
        $articles = Articles::paginate(3);
        return response()->json([
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return response(this->autorize('create', self::class));
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
            $user = User::where('id', '!=', auth()->user()->id)->get();
            Notification::send($user, new ArticleNotification($article));
            event(new EventPublicArticle($article->name));

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
        $article = Articles::findOrFail($id);
        $comment = ArticleComment::where('article_id', $id)->where('accept', 1)->paginate(3);
        return response()->json([
            'article' => $article,
            'comments' => $comment
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
            'article' => $article,
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
            $user = User::where('id', '!=', auth()->user()->id)->get();
            Notification::send($user, new ArticleNotification($article));

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
        $accept = Gate::authorize('delete-article');
        $article = Articles::findOrFail($id);
        ArticleComment::where('article_id', $id)->delete();
        $result = ($article->delete());
        $response = [
            'accept' => $accept,
            'result' => $result
        ];

        return response($response);
    }
}
