@extends('layouts.layout')
@section('content')
    <form method="post"> 
        @csrf
        <button type="submit">Отправить</button>
    </form>
@endsection
