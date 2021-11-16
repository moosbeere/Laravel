@extends('layouts.layout')
@section('content')
    <h3>{{$article->name}}</h3>
    <i>{{$article->data_create}}</i>
    <p>{{$article->short_text}}</p>
    <br/>
    @foreach($comments as $comment)
        <b>{{ $comment->title }}</b>
        <p>{{ $comment->comment }}</p>
    @endforeach

<br>
{{ $comments->links()}}


<form method="POST" action="/articles/{{$article->id}}/comment">
            @csrf
            <!-- <input type="hidden" name="article_id" value="{{$article->id}}"/> -->

            <div class="mb-3">
                <label class="form-label">Заголовок комментария</label>
                <input type="text" name="comment_title" class="form-control"/>
            </div>
            <div class="mb-3">
                <label class="form-label">Комментарий</label>
                <textarea class="form-control" name="comment" rows="3"></textarea>
            </div>
            <button class="btn btn-primary">Отправить</button>
        </form>
    </div>

@endsection