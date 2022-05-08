@extends('dashboard.layouts.app')

@section('content')
<form action="{{ route('users.update_psw', $user) }}" method="POST">
    @method('post')
    @csrf
    <div class="mb-3">
      <label for="psw" class="form-label">Enter new password for user {{ $user->name }}</label>
      <input type="password" class="form-control" id="psw" type="text" name="psw">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection