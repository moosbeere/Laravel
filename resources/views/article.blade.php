@extends('layouts.layout')
@section('content')

    <div>

    <h1>О нас</h1>
        <p>Lorem Ipsum</p>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
</p>

    </div>
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
