@extends('layouts.layout')
@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Article</th>
      <th scope="col">Title</th>
      <th scope="col">Comment</th>
    </tr>
  </thead>
  <tbody>
  @for($i=1; $i<$comment->count(); $i++)
    <tr>
      <th scope="row">{{$i}}</th>
      <td>{{$comment[$i]->title}}</td>
    </tr>
    @endfor
  </tbody>
</table>
@endsection