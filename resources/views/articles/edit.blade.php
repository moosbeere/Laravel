@extends('layouts.layout')
@section('content')

    <form method="post" action="/articles/{{$article->id}}/edit"> 
        @csrf

        <h1>Редактирование новости</h1>
        <div>
            <input type="text" name="name" id="name" value="{{$article->name}}">
            <label for="date">Дата создания</label>
            <input type="date" name="date" id="date" value = "{{$article->data_create}}">
        </div>
        <div>
             <textarea name="description" id="description" cols="30" rows="10" placeholder="Описание новости">{{$article->short_text}}</textarea>
        </div>

        <button type="submit">Сохранить</button>
    </form>
@endsection
