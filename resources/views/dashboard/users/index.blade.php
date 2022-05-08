@extends('dashboard.layouts.app')

@section('content')

@if (\Session::has('success'))
    <div class="alert alert-success">
        {!! \Session::get('success') !!}
    </div>
@endif

<div class="row my-2">
  <div class="col m-0">
    <a href="{{ route("user.create") }}" role="button" class="btn btn-primary">Create user</a>
  </div>
</div>

<div class="row">
  <div class="col">
    <ul class="list-group list-group-horizontal row">
      <li class="list-group-item col-1"><b>ID</b></li>
      <li class="list-group-item col-9"><b>Name</b></li>
      <li class="list-group-item col-2"><b>Actions</b></li>
    </ul>
    @foreach ($users as $user)
    <ul class="list-group list-group-horizontal row">
      <li class="list-group-item col-1">{{ $user->id }}</li>
      <li class="list-group-item col-9">{{ $user->name }}</li>
      <li class="list-group-item col-2">
        <a href="{{ route("user.edit_name", $user) }}" role="button" class="btn btn-primary">Change username</a>
        <a href="{{ route("user.edit_psw", $user) }}" role="button" class="btn btn-primary">Change password</a>
        
        <form method="POST" action="{{route("users.destroy", $user)}}">
        @CSRF
        @METHOD('POST')
        <div class="form-group">
            <input type="submit" class="btn btn-danger delete-user" value="Delete user">
        </div>
      </form>
      </li>
    </ul>
    @endforeach
  </ul>
</div>
</div>
@endsection