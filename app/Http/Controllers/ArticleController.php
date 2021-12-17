<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\Role;
use App\Models\ArticleComment;




class ArticleController extends Controller
{
    public function index(){
        $articles = Articles::paginate(5);
        $roles = Role::all();
        return view('articles.index',['articles'=> $articles, 'roles' => $roles]);
    }

    public function create(){

        $this->authorize('create', [self::class]);
            return view('articles.create');
    }

    public function store($id=null, Request $request){
       
        $request->validate([
            'name' => 'required',
            'date' => 'required'
        ]);

        if ($id == null) $article = new Articles();
        else $article = Articles::findOrFail($id);
        $article->name = request('name');
        $article->short_text = request('description');
        $article->data_create = request('date');
        $article->save();
        if ($id == null) return redirect('/articles');
        else return redirect('/articles/'.$id);
    }

    public function view($id){
        $article = Articles::findOrFail($id);

        $comments = ArticleComment::where('article_id', $id)->where('accept', 1)->paginate(3);

        return view('articles.view',['article'=>$article, 'comments'=>$comments]);
    }

    public function edit($id){
        $article = Articles::findOrFail($id);
        return view('articles.update', ['article'=>$article]);
    }

    public function destroy($id){
        $article = Articles::findOrFail($id);
        ArticleComment::where('article_id', $article->id)->delete();
        $article->delete();
        return redirect ('/articles');
    }
}


       