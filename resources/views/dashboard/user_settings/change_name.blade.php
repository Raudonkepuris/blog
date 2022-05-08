@extends('dashboard.layouts.app')

@section('content')

<div class="row">
<form action="{{ route('user_settings.update_name', $user) }}" method="POST">
    @method('post')
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">User name</label>
      <input class="form-control" id="name" type="text" name="name" value="{{ $user->name }}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>


@endsection