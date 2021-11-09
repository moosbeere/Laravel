<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;

class ArticleController extends Controller
{
    public function index(){
        $articles = Articles::latest()->get();
        return view('main', ['letters' => $articles]);
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
        $article = new Articles();
        $article->name = request('name');
        $article->shorttext = request('description');
        $article->dataCreate = request('date');
        $article->save();
        return redirect('/')->with('msg', 'Новость создана!');

    }

}

