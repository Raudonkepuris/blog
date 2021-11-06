@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row justify-content-center">
<div class="col-8">
    <div class="row">
        <div class="col">
            Random post:
        </div>
    </div>
    <div class="row border">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h4>
                        {{ $post->title }}
                    </h4>
                </div>
                <div class="col text-right">
                    {{ $post->created_at->diffForHumans() }}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    {{ $post->content }}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    {{ $post->upvotes }} likes,
                    {{ $post->downvotes }} downvotes
                </div>
            </div>
            <div class="row">
                <div class="col">
                    {{ $post->comments->count() }} comments
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
