@extends('layouts.app')
@section('title', 'Posts')

@section('content')

<div class="row justify-content-center">
    <div class="col-2 p-0">
        <div class="row my-1 mx-3">
        <p>Tags: </p>
        </div>
        <div class="row my-1 mx-3">
            <form action="{{ route('posts.index') }}" method="GET">
                @foreach ($tags as $tag)
                <div>
                    <input type="checkbox" id="{{ $tag->name }}" name="tags[]" value="{{ $tag->name }}" {{ !empty(request()->tags) ? in_array($tag->name, request()->tags) ? 'checked' : '' : ''}}>
                    <label for="{{ $tag->name }}">{{ $tag->name }}</label>
                </div>
                @endforeach
                <input class="btn btn-primary" type="submit" value="Submit">
            </form>
        </div>
    </div>
    <div class="col-8">

        @can('create', 'App\\Models\Post')
        <a href="{{ route('posts.create') }}" type="button" class="btn btn-primary">Create new post</a>
        @endcan

        @if (session()->has('postDeletion'))
        <div class="alert alert-success">
            {{ session('postDeletion') }}
        </div>
        @endif
        <div class="row justify-content-center">
        {{ $posts->links() }}
        </div>

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
                            {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
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
                            {{ $posts->where('id', $post->id)->first()->comments->count() }} comments
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span>Tags:
                            @foreach ($posts->where('id', $post->id)->first()->tags as $tag)         
                                {{ $tag->name }},
                            @endforeach
                            </span>
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
        <div class="row justify-content-center">
        {{ $posts->links() }}
        </div>

    </div>
    <div class="col-2"></div>
</div>

@endsection
