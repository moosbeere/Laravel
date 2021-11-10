@extends('layouts.layout')
@section('content')

<?php
    //echo '<p>'.var_dump($articles).'</p>';
?>

@foreach($articles as $article)
    <p>{{ $article->name }} - {{ $article->shorttext }} - {{ $article->dataCreate }}</p>
@endforeach

@endsection

