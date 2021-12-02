@extends('layouts.layout')
@section('content')
    <h3>Добавить статью</h3>
    <form method="post" action="/articles">
        @csrf
        <div>
            <input type="text" name="name" id="name" placeholder="Введите заголовок">
            <label for="date">Дата создания</label>
            <input type="date" name="date" id="date" value="2021-10-12">
        </div>
        <div>
            <textarea name="description" id="description" cols="30" rows="10" placeholder="Описание новости"></textarea>
        </div>

        <button type="submit">Отправить</button>
    </form>

@endsection('content')
