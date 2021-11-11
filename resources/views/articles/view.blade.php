@extends  ('layouts.layout')
@section('content')
    <h1>{{ $article -> name}}</h1>
    <p>{{ $article -> data_create}}</p>
    <p>{{ $article -> short_text}}</p>
@endsection