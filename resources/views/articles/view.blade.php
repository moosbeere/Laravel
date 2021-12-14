@extends('layouts.layout')
@section('link')
    <a class="nav-link active" href="/articles/{{$article->id}}/update">Редактировать</a>
    <a class="nav-link active" href="/articles/{{$article->id}}/delete">Удалить</a>
@endsection
@section('content')
    <h3>{{$article->name}}</h3>
    <i>{{$article->data_create}}</i>
    <p>{{$article->short_text}}</p>
    <br/>

    @foreach($comments as $comment)
        <b>{{$comment->title}}</b>
        <p>{{$comment->comment}}</p>
    @endforeach
    <br/>
    {{ $comments ->links() }}
    <br>
    @isset($_GET['result'])
        @if($_GET['result'] == 1)
        <b>Ваш комментарий ожидает модерации.</b>
        @endif
    @endisset
    <br>
    <br>
    <br>

    <form method="POST" action="/comment/{{$article->id}}/create">
            @csrf
            <!-- <input type="hidden" name="article_id" value="{{$article->id}}"/> -->

            <div class="mb-3">
                <label class="form-label">Заголовок комментария</label>
                <input type="text" name="comment_title" class="form-control"/>
            </div>
            <div class="mb-3">
                <label class="form-label">Комментарий</label>
                <textarea class="form-control" name="comment" rows="3" required></textarea>
            </div>
            <button class="btn btn-primary">Добавить</button>
        </form>
    </div>

    
@endsection

