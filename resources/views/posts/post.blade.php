@extends('layouts.app')

@section('title', $post->title)
@section('livewireStyles') @livewireStyles @endsection
@section('livewireScripts') @livewireScripts @endsection

@section('content')

<div class="row justify-content-center my-2">
    <div class="col-8">

        @livewire('post', ['post' => $post])

        @livewire('voting-section', ['post' => $post])

        @livewire('comment-section', ['comments' => $comments, 'errors' => $errors->any() ? : NULL, 'post' => $post])

    </div>
</div>

@endsection
