@extends('layouts.layout')
@section('content')
    <h2>{{ $article -> name}}</h2>
    <i>{{ $article -> data_create}}</i>
    <p>{{ $article -> short_text}}</p>

    <a href="/articles/{{$article->id}}/edit" class="btn btn-secondary">Редактировать</a>
    <a href="/articles/{{$article->id}}/delete" class="btn btn-primary">Удалить</a>
    <br/>
    <br/>
    <h4>Комментарии</h4>
    @foreach($comments as $comment)
        <b>{{ $comment->title }}</b>
        <p>{{ $comment->comment }}</p>
    @endforeach
    <br>
    <div> {{ $comments->links() }}</div>

    <form action="/articles/{{ $article->id }}/comments" method="post">
        @csrf
        <h3>Добавить комментарий</h1>
        <div>
            <label for="comment-title">Введите заголовок</label>
            <input type="text" name="comment-title" id="comment-title">
            <input type="text" name="comment" placeholder="Введите текст">
        </div>
        <div>
            <button type="submit">Отправить</button>
        </div>

    </form>
@endsection