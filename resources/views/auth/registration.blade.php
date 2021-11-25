@extends('layouts.layout')
@section('content')

<h3>Регистрация</h3>

<form action="/custom-registration" method="post">
    @csrf
    <div>
        <label for="name">Введите имя пользователя</label>
        <input type="text" name="name" id="name">
        <input type="email" name="email" id="email" placeholder="Введите e-mail">
        <label>
            <input type="password" name="password" id="password"> Придумайте пароль (не менее 6 символов)
        </label>
        <button type="submit">Зарегстрироваться</button>
    </div>
    @if($errors->has('email'))
        <span>{{ $errors->first('email')}}</span>
    @endif
</form>
@endsection