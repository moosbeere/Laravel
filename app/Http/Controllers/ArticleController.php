<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\ArticleComment;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function index(){
        $articles = Articles::paginate(3);
        return view('articles.index', ['articles' => $articles]);
    }
    
    public function contact(){
        $contact=[
            'adres'=>'Большая семеновская',
            'tel'=>'8(495)232-2323',
            'email'=>'@mospolitech.ru'
        ];


        return view('contact', ['contact'=>$contact]);
    }

    public function create(){
        $response = Gate::inspect('create');
        if ($response->allowed()) {
            return view('articles.create');
        } else {
            $response->message('1234');
            var_dump($response);
        }
        
    }

    public function show($id){
        $article = Articles::findOrFail($id);
        $comment = ArticleComment::where('article_id', $id)->where('accept', 1)->paginate(3);
        return view('articles.view', ['article' => $article, 'comments'=>$comment]);
    }

    public function store($id = null){
        if ($id == null) $article = new Articles();
        else $article = Articles::findOrFail($id);
            $article->name = request('name');
            $article->short_text = request('description');
            $article->data_create = request('date');
            $article->save();
        return redirect('/articles/'.$article->id);

    }

    public function update($id){
        Gate::authorize('update-article');
        $article = Articles::findOrFail($id);
        return view('articles.edit', ['article' => $article]);
    }

    public function destroy($id){
        Gate::authorize('delete-article');
        $article = Articles::findOrFail($id);
        ArticleCommment::where('article_id', $id)->delete();
        $article->delete();
        return redirect('/articles');
    }
}

