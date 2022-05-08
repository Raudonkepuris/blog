@extends('dashboard.layouts.app')

@section('content')
@if (\Session::has('success'))
    <div class="alert alert-success">
        {!! \Session::get('success') !!}
    </div>
@endif
<form action="{{ route('tags.store') }}" method="POST">
    @method('post')
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Tag name</label>
      <input class="form-control" id="name" type="text" name="name">
    </div>
    <div class="mb-3 form-check form-switch">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="display">
        <label class="form-check-label" for="flexSwitchCheckDefault" >Display tag as an option in post section</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection