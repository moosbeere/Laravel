<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;

class ArticleController extends Controller
{
    public function index(){
        $articles = Articles::where('name', 'new letter')->get();
        return view('main', ['articles' => $articles]);
    }

    public function article(){
        return view('article');
    }

    public function create(){
        $article = new Articles();
        $article->name = request('name');
        $article->shorttext = request('description');
        $article->dataCreate = request('date');
        return $article->save();

    }
   public function contact(){
        $contact=[
            'adres'=>'Большая семеновская',
            'tel'=>'8(495)232-2323',
            'email'=>'@mospolitech.ru'
        ];


        return view('contact', ['contact'=>$contact]);
    }
}

