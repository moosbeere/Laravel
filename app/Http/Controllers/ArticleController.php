<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\ArticleComment;
use Illuminate\Support\Facades\Gate;


class ArticleController extends Controller
{
    public function index(){
        $aricles = Articles::paginate(3);

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

        return redirect('/articles/'.$article->id);
    }

    public function view($id){
        $article = Articles::findOrFail($id);
        $comments = ArticleComment::where('article_id', $id)->where('accept', 1)->paginate(3);
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
        return redirect('/articles');

    }
}

