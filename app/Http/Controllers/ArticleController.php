<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\ArticleComment;


class ArticleController extends Controller
{
    public function index(){
<<<<<<< HEAD
        $aricles = Articles::paginate(3);
=======
        $aricles = Articles::all();
>>>>>>> changed views & routes & controllers (refactor from valentin)

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
<<<<<<< HEAD
        $comments = ArticleComment::where('article_id', $id)->paginate(3);

        return view('articles.view',['article'=>$article, 'comments'=>$comments]);
    }
}
=======
>>>>>>> changed views & routes & controllers (refactor from valentin)

        return view('articles.view',['article'=>$article]);
    }
}