@extends('dashboard.layouts.app')

@section('content')
<ul class="list-group list-group-horizontal row">
    <li class="list-group-item col-1"><b>ID</b></li>
    <li class="list-group-item col-8"><b>Name</b></li>
    <li class="list-group-item col-1"><b>Displayed</b></li>
    <li class="list-group-item col-2"><b>Actions</b></li>
  </ul>
  @foreach ($tags as $tag)
  <ul class="list-group list-group-horizontal row">
    <li class="list-group-item col-1">{{ $tag->id }}</li>
    <li class="list-group-item col-8">{{ $tag->name }}</li>
    <li class="list-group-item col-1">{{ $tag->display }}</li>
    <li class="list-group-item col-2">
        <a href="{{ route("tags.edit", $tag) }}" role="button" class="btn btn-primary">Edit</a>
        <a type="button" class="btn btn-danger">Delete</a>
    </li>
  </ul>
  @endforeach
@endsection