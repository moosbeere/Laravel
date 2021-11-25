@extends('layouts.layout')
@section('content')

    <div>
        <p>Главная страница</p>
    </div>
    @if (Auth::guest())
        <a href="/register">Регистрация</a>
        <a href="/login">Войти</a>
    @else
        <a href="/logout">Выйти</a>
    @endif
    
@endsection

