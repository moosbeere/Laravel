<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;

class ArticleController extends Controller
{
    public function index(){
        return view('main');
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

