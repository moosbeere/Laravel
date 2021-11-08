@extends('layouts.layout')
@section('content')

    <form method="post"> 
        @csrf

        <h1>Новости</h1>
        <div>
            <input type="text" name="name" id="name" placeholder="Введите заголовок">
            <label for="date">Дата создания</label>
            <input type="date" name="date" id="date">
        </div>
        <div>
             <textarea name="description" id="description" cols="30" rows="10" placeholder="Описание новости"></textarea>
        </div>

        <button type="submit">Отправить</button>
    </form>
@endsection
