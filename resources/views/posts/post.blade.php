@extends('layouts.app')

@section('title', $post->title)
@section('livewireStyles') @livewireStyles @endsection
@section('livewireScripts') @livewireScripts @endsection

@section('includes')
@endsection



@section('content')

<style>
    img {
    max-width: 100%;
    height: auto;
}
p {
    overflow-wrap: break-word;
}
</style>

<div class="row justify-content-center post-page">
    <div class="col-8 center">

        @if(Session::has('updated'))
            <div class="row mb-2">
                <p class="alert alert-success w-100">{{ Session::get('updated') }}</p>
            </div>
        @endif

        @can('update', $post)
        <div class="row mb-2">
            <div class="col">
                <a href="{{ route("posts.edit", $post->id) }}" type="button" class="btn btn-primary m-1">Edit</a>
            </div>
        </div>
        @endcan

        <div class="row mx-1">
            <h1>{{ $post->title }}</h1>
        </div>

        <div class="row mx-1" id="content">
            <p>{!! $post->content !!}</p>
        </div>

        @livewire('voting-section', ['post' => $post])

        @livewire('comment-section', ['comments' => $comments, 'errors' => $errors->any() ? : NULL, 'post' => $post])

    </div>
</div>

@endsection
