@extends('layouts.layout')
@section('comment')
        <a href="/articles/{{$article->id}}/edit" class="nav-link active">Редактировать</a>
        <a href="/articles/{{$article->id}}/delete" class="nav-link active">Удалить</a>
@endsection
@section('content')
    <h2>{{ $article -> name}}</h2>
    <i>{{ $article -> data_create}}</i>
    <p>{{ $article -> short_text}}</p>

    <br/>
    <br/>
    <h4>Комментарии</h4>
    @foreach($comments as $comment)
        <b>{{ $comment->title }}</b>
        <p>{{ $comment->comment }}</p>
    @endforeach
    <br>
    <div> {{ $comments->links() }}</div>

    <br>
    @isset($_GET['result'])
    @if ($_GET['result'] == 1)
    <b>Ваш комментарий ожидает модерацию</b>
    @endif
    @endisset
    <form action="/comment/{{ $article->id }}/create" method="post">
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
    <div id="app">
    <example-component>
</example-component>
    </div>
@endsection