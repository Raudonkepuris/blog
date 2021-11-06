@extends('layouts.app')
@section('title', 'Posts')

@section('content')

<div class="row justify-content-center">
    <div class="col-8">

        @can('create_posts')
        <a href="{{ route('posts.create') }}" type="button" class="btn btn-primary">Create new post</a>
        @endcan


        @foreach ($posts as $post)
        <a href="{{ route("posts.show", $post->id) }}" class="text-dark" style="text-decoration: none;">
            <div class="row border my-2">

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

                    @canany(['edit_posts', 'delete_posts'])
                    <div class="row">
                        <div class="col pb-2">
                            @can('edit_posts')
                            <a type="button" class="btn btn-primary">Edit</a>
                            @endcan
                            @can('delete_posts')
                            <a type="button" class="btn btn-danger">Delete</a>
                            @endcan

                        </div>
                    </div>

                    @endcanany
                    
                </div>

            </div>
        </a>
        @endforeach
    </div>
</div>

@endsection
