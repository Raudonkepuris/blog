@extends('dashboard.layouts.app')

@section('content')

<div class="row">
@if (\Session::has('error'))
    <div class="alert alert-danger">
        {!! \Session::get('error') !!}
    </div>
@endif
</div>

<div class="row">
<form action="{{ route('user_settings.update_psw', $user) }}" method="POST">
    @method('post')
    @csrf
    <div class="mb-3">
      <label for="curr-psw" class="form-label">Current password</label>
      <input type="password" value="" class="form-control" id="curr-psw" name="curr-psw" required>
    </div>
    <div class="mb-3">
      <label for="new-psw" class="form-label">New password</label>
      <input type="password" value="" class="form-control" id="new-psw" name="new-psw" required>
    </div>
    <div class="mb-3">
      <label for="new-rpsw" class="form-label">Repeat password</label>
      <input type="password" value="" class="form-control" id="new-rpsw" name="new-rpsw" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

@endsection