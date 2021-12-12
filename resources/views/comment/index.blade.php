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
  @for($i=0; $i<$comment->count(); $i++)
    <tr>
      <th scope="row">{{$i+1}}</th>
      <td>{{$article[$i]->name}}</td>
      <td>{{$comment[$i]->title}}</td>
      <td>{{$comment[$i]->comment}}</td>
      <td>
        @if($comment[$i]->accept == 0)
        <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
            <a class="btn btn-outline-primary" href="/comment/{{$comment[$i]->id}}/accept">Принять</a>
            <a class="btn btn-outline-primary" href="/comment/{{$comment[$i]->id}}/reject">Отклонить</a> 
        </div>  
        @else 
        <div class="text-center">Активен</div> 
        @endif
    </td>
    </tr>
  @endfor
  </tbody>
</table>
@endsection