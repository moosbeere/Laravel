@extends  ('layouts.layout')
@section('content')
    <h1>{{ $article -> name}}</h1>
    <p>{{ $article -> data_create}}</p>
    <p>{{ $article -> short_text}}</p>
    <br>
    <h2>Комментарии</h2>
    <div>
        @foreach($comments as $comment)
            <b>{{ $comment->title }}</b>
            <p>{{ $comment->comment }}</p>
        @endforeach
    </div>
    <br>
    {{ $comments -> links() }}

    <a href="/articles/{{$article->id}}/edit" class="btn">Редактировать</a>
    <a href="/articles/{{$article->id}}/delete" class="btn">Удалить</a>


    <form action="/articles/{{ $article->id }}/comment" method="post">
        @csrf
        <h3>Оставить комментарий</h3>
        <label for="title">Тема</label>
        <input type="text" name="title" id="title">
        <div>
        <textarea name="comment" id="" cols="30" rows="10" placeholder="Введите текст"></textarea>
        </div>
        <button type="submit">Отправить</button>
    </form>
@endsection