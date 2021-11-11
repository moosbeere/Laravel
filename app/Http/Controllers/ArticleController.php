<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;

class ArticleController extends Controller
{
    public function index(){
        $aricles = Articles::all();

        return view('articles.index',['articles'=> $aricles]);
    }

    public function create(){
        return view('articles.create');
    }

    public function store(){
        $article = new Articles();
        $article->name = request('name');
        $article->short_text = request('description');
        $article->data_create = request('date');
        $article->save();

        return redirect('articles');
    }

    public function view($id){
        $article = Articles::findOrFail($id);

        return view('articles.view',['article'=>$article]);
    }
}