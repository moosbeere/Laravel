@extends('layouts.layout')
@section

<div>
    @foreach ($name as $key)
    <p>{{$key}}</p>
    @endforeach


</div>
@endsection
