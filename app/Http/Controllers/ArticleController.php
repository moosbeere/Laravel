<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;

class ArticleController extends Controller
{
    public function index(){
        $bla=[
            'adres'=>'Большая семеновская',
            'tel'=>'8(495)232-2323',
            'email'=>'@mospolitech.ru'
        ];


        return view('contact', ['name'=>$bla]);
    }

    public function create(){
        $article = new Articles();
        $article->setAttribute('name', 'tets');
        $article->setAttribute('shorttext', 'shortdescription');
        $article->setAttribute('dataCreate', '20.10.2021');
        return $article->save();

    }

}

