@extends('layouts.layout')
@section('content')
    <h3>{{$article->name}}</h3>
    <i>{{$article->data_create}}</i>
    <p>{{$article->short_text}}</p>
    <br/>
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    @foreach($comments as $comment)
        <b>{{$comment->title}}</b>
        <p>{{$comment->comment}}</p>
    @endforeach
    <br/>
    {{ $comments ->links() }}
    <br>
    <div class="col-sm-4">
        <form method="POST" action="/article-comments">
            @csrf
            <input type="hidden" name="article_id" value="{{$article->id}}"/>
=======
    @foreach($article->comments as $comment)
=======
    @foreach($comments as $comment)
>>>>>>> paginate
=======
    @foreach($comments as $comment)
>>>>>>> 22d6e2089f0bf144673c74c60e7df25ca7471209
        <b>{{ $comment->title }}</b>
        <p>{{ $comment->comment }}</p>
    @endforeach

<br>
{{ $comments->links()}}


<form method="POST" action="/articles/{{$article->id}}/comment">
            @csrf
            <!-- <input type="hidden" name="article_id" value="{{$article->id}}"/> -->
<<<<<<< HEAD
>>>>>>> comment: controller
=======
>>>>>>> 22d6e2089f0bf144673c74c60e7df25ca7471209

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
<<<<<<< HEAD
<<<<<<< HEAD
@endsection
@endsection

=======

@endsection
>>>>>>> comment: controller
=======

@endsection
>>>>>>> 22d6e2089f0bf144673c74c60e7df25ca7471209
