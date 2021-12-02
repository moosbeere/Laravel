<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\ArticleComment;

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
        return view('articles.create');
    }

    public function show($id){
        $article = Articles::findOrFail($id);
        $comment = ArticleComment::where('article_id', $id)->paginate(3);
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
        $article = Articles::findOrFail($id);
        return view('articles.edit', ['article' => $article]);
    }

    public function destroy($id){
        Articles::findOrFail($id)->delete();
        return redirect('/articles');
    }
}

