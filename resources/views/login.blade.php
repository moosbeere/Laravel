@extends('layouts.layout')
@section('content')

<form action="custom-login" method="post">
@csrf
    <div>

        <input type="email" name="email" placeholder="Введите e-mail">
        <input type="password" name="password" id="password">
    </div>
    <div>
        <label>
            <input type="checkbox" name="remember" id="">Запомнить меня
        </label>
        <button type="submit">Войти</button>
    </div>
</form>

@endsection