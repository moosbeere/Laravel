@extends('layouts.layout')
@section ('content')
<div>
    @foreach ($contact as $key)
    <p>{{$key}}</p>
    @endforeach
</div>
@endsection
