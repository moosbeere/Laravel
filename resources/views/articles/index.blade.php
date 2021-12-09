@extends('layouts.layout')
@section('content')
    <div class="row">
        <h3>Статьи</h3>
        <div class="col-md-4 col-sm-12">
            <div class="list-group">
                @foreach($articles as $article)
                    <a href="/articles/{{$article->id}}" class="list-group-item list-group-item-action">{{$article->name}}</a>
                @endforeach
                @can('create-article')
                <a class="btn btn-primary" href="/articles/create">Добавить статью</a>
                @endcan
            </div>
        </div>
    </div>
    {{ $articles->links() }}
@endsection