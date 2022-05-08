@extends('dashboard.layouts.app')

@section('content')
<form action="{{ route('users.store') }}" method="POST">
    @method('post')
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">User name</label>
      <input class="form-control" id="name" type="text" name="name">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">User email</label>
      <input class="form-control" id="email" type="text" name="email">
    </div>
    <div class="mb-3">
      <label for="psw" class="form-label">User password</label>
      <input class="form-control" id="psw" type="password" name="psw">
    </div>
    <div class="mb-3">
      <label for="rpsw" class="form-label">Repeat user password</label>
      <input class="form-control" id="rpsw" type="password" name="rpsw">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection