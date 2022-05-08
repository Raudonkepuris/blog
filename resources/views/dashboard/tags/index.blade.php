@extends('dashboard.layouts.app')

@section('content')

@if (\Session::has('success'))
    <div class="alert alert-success">
        {!! \Session::get('success') !!}
    </div>
@endif

<div class="row my-2">
  <div class="col m-0">
    <a href="{{ route("tags.create") }}" role="button" class="btn btn-primary">Create tag</a>
  </div>
</div>

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
        <form method="POST" action="{{route("tags.destroy", $tag)}}">
        @CSRF
        @METHOD('POST')
        <div class="form-group">
            <input type="submit" class="btn btn-danger delete-user" value="Delete tag">
        </div>
      </form>
    </li>
  </ul>
  @endforeach
@endsection