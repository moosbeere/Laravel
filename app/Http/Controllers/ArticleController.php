<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;

class ArticleController extends Controller
{
    public function index(){
<<<<<<< Updated upstream
        $bla=[
=======
        return view('main');
    }
    public function contact(){
        $contact=[
>>>>>>> Stashed changes
            'adres'=>'Большая семеновская',
            'tel'=>'8(495)232-2323',
            'email'=>'@mospolitech.ru'
        ];


        return view('contact', ['contact'=>$contact]);
    }

    public function create(){
        $article = new Articles();
<<<<<<< Updated upstream
        $article->setAttribute('name', 'tets');
        $article->setAttribute('shorttext', 'shortdescription');
        $article->setAttribute('dataCreate', '20.10.2021');
=======
        $article->name = request('name');
        $article->shorttext = request('description');
        $article->dataCreate = request('date');
>>>>>>> Stashed changes
        return $article->save();

    }

}

