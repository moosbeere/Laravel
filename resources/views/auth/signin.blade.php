@extends ('layouts.layout')
@section('content')
<form action="/auth/signin" method="post">
    @csrf
    <h3>Авторизация</h3>
    <div>
        <label>
            <input type="email" name="email" id="email">Введите e-mail
        </label>
        <label>
            <input type="password" name="password" id="">Введите пароль
        </label>
    </div>
    <button type="submit">Войти</button>
</form>
@endsection