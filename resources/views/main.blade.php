@extends('layouts.layout')
@section('content')

    <div>
        <p>{{ session('msg') }}</p>
    </div>

    @foreach($letters as $article)
        <div>
            <p>{{ $article->name }} - {{ $article->shorttext }} - {{ $article->dataCreate }}</p>
        </div>
    @endforeach


@endsection

