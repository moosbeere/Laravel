<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;

class ArticleController extends Controller
{
    public function index(){
        $articles = Articles::all();
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
        return view('articles.view', ['article' => $article]);
    }

    public function store(){
        $article = new Articles();
        $article->name = request('name');
        $article->short_text = request('description');
        $article->data_create = request('date');
        $article->save();
        return redirect('/articles');

    }

}

