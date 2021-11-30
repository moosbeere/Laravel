@extends ('layouts.layout')
@section('content')
<form action="/auth/registration" method="post">
    @csrf
    <h3>Регистрация</h3>
    <div>
        <label for="name">Введите имя</label>
        <input type="text" name="name" id="name">
        <input type="email" name="email" id="email" placeholder="Введите e-mail">
        <label>
            <input type="password" name="password" id="">Придумайте пароль (не менее 6 символов)
        </label>
    </div>
    <button type="submit">Зарегистрироваться</button>
</form>
@endsection