<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\ArticleComment;
<<<<<<< HEAD

=======
>>>>>>> paginate

class ArticleController extends Controller
{
    public function index(){
<<<<<<< HEAD
<<<<<<< HEAD
        $aricles = Articles::paginate(3);
=======
        $aricles = Articles::all();
>>>>>>> changed views & routes & controllers (refactor from valentin)
=======
        $articles = Articles::paginate(2);
>>>>>>> paginate

        return view('articles.index',['articles'=> $articles]);
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
<<<<<<< HEAD
        $comments = ArticleComment::where('article_id', $id)->paginate(3);

        return view('articles.view',['article'=>$article, 'comments'=>$comments]);
    }
}
=======
>>>>>>> changed views & routes & controllers (refactor from valentin)

        return view('articles.view',['article'=>$article]);
=======
        $comment = ArticleComment::where('article_id', $id)->paginate(2);
        return view('articles.view',['article'=>$article, 'comments'=>$comment]);
>>>>>>> paginate
    }
}