@extends('dashboard.layouts.app')

@section('content')

<div class="row">
<form action="{{ route('user_settings.update_email', $user) }}" method="POST">
    @method('post')
    @csrf
    <div class="mb-3">
      <label for="email" class="form-label">User email</label>
      <input class="form-control" id="email" type="text" name="email" value="{{ $user->email }}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

@endsection