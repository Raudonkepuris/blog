@extends('layouts.app')

@section('title', $post->title)
@section('livewireStyles') @livewireStyles @endsection
@section('livewireScripts') @livewireScripts @endsection

@section('includes')
@endsection



@section('content')

<style>
    .button{
        padding: 5px 15px;
        color: #ddd;
        background-color: #333;
        border: #ddd 2px solid;
        border-radius: 10px;
        text-decoration: none;
    }

    .button:hover{
        text-decoration: none;
        color: lightblue;
        border-color: lightblue;
        background-color: #111;
    }

    #content *{
        max-width: 100%;
    }
</style>

<div class="row justify-content-center">
    <div class="col-8" id="center">

        @if(Session::has('updated'))
            <div class="row mb-2">
                <p class="alert alert-success w-100">{{ Session::get('updated') }}</p>
            </div>
        @endif

        <div class="row mb-2">
            @can('update', $post)
            <a href="{{ route("posts.edit", $post->id) }}" type="button" class="btn btn-primary m-1">Edit</a>
            @endcan
        </div>

        <div class="col p-0 m-0">
            <div class="row">
                <h1>{{ $post->title }}</h1>
            </div>
    
            <div class="row" id="content">
                <p>{!! $post->content !!}</p>
            </div>
        </div>

        @livewire('voting-section', ['post' => $post])

        @livewire('comment-section', ['comments' => $comments, 'errors' => $errors->any() ? : NULL, 'post' => $post])

    </div>
</div>

@endsection
