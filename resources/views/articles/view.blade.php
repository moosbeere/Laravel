@extends('layouts.layout')
@section('content')
    <h2>{{ $article -> name}}</h2>
    <i>{{ $article -> data_create}}</i>
    <p>{{ $article -> short_text}}</p>
@endsection