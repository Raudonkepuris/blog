@extends('dashboard.layouts.app')

@section('content')
<div class="row justify-content-center">
<h4>Dasboard</h4>
</div>
<div class="row justify-content-center">
    <div class="col-3">
        <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Tags</a>
            </li>
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Tags</a>
                <ul class="dropdown-menu">
                  <li><a class="nav-item" href="#">Create</a></li>
                  <li><a class="nav-item" href="#">Edit</a></li>
                </ul>
              </li>
        </ul>
    </div>
    <div class="col-9">

    </div>
</div>
@endsection