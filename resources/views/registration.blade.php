@extends('layouts.layout')
@section('content')

<h3>Регистрация</h3>
<form action="custom-registration" method="post">
    @csrf
    <div>
        <label for="name">Введите имя</label>
        <input type="text" name="name" id="name">
        <input type="email" name="email" placeholder="Введите e-mail">
        <label for="password">Придумайте пароль (минимум 6 символов)</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <label>
            <input type="checkbox" name="remember" id="">Запомнить меня
        </label>
        <button type="submit">Регистрация</button>
    </div>
    <div>
    @if ($errors->has('email'))
            <span> {{ $errors->first('email') }}</span>
        @endif
    </div>
</form>

@endsection