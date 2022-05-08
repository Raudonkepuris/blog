@extends('dashboard.layouts.app')

@section('content')

@if (\Session::has('success'))
    <div class="alert alert-success">
        {!! \Session::get('success') !!}
    </div>
@endif

<div class="row">
    <h5>User information:</h5>
</div>

<div class="row">
    <span>User name: {{ $user->name}} </span>
    <a type="button" class="btn btn-link dashboard-link-modify" href="{{ route("user_settings.change_name", $user) }}">Change</a>
</div>

<div class="row">
    <span>Email: {{ $user->email}} </span>
    <a type="button" class="btn btn-link dashboard-link-modify" href="{{ route("user_settings.change_email", $user) }}">Change</a>
</div>

<div class="row">
    <a type="button" class="btn btn-link dashboard-link-modify" href="{{ route("user_settings.change_psw", $user) }}">Change password</a>
</div>


@endsection