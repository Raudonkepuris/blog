@extends('layouts.app')

@section('title', $post->title)
@section('livewireStyles') @livewireStyles @endsection
@section('livewireScripts') @livewireScripts @endsection

@section('content')

<div class="row justify-content-center my-2">
    <div class="col-8">
        <div class="row">
            @canany(['edit_posts', 'delete_posts'])
            @can('edit_posts')
            <a type="button" class="btn btn-primary m-1">Edit</a>
            @endcan
            @can('delete_posts')
            <a type="button" class="btn btn-danger m-1">Delete</a>
            @endcan
            @endcanany
        </div>

        <div class="row">
            <h1>{{ $post->title }}</h1>
        </div>

        <div class="row">
            <p>{{ $post->content }}</p>
        </div>

        <div class="row justify-content-start mb-4">
            <div class="col px-0">
                <img src="{{ asset('assets/thumbsup.png') }}" alt="Likes" style="display:inline" width="20">
                <p style="display:inline">{{ $post->upvotes }}</p>

                <img src="{{ asset('assets/thumbsdown.png') }}" alt="Dislikes" style="display:inline" width="20">
                <p style="display:inline">{{ $post->downvotes }}</p>
            </div>
        </div>

        @livewire('comment-section', ['comments' => $comments, 'errors' => $errors->any() ? : NULL, 'post' => $post])

    </div>
</div>

@endsection
