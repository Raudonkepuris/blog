@extends('layouts.app')
@section('title', 'Posts')

@section('content')

<div id="posts-page" class="row justify-content-center">

    <div class="col-2 p-0">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 tags">
                <div class="row">
                    <p>Tags: </p>
                </div>
                <div class="row">
                    <form action="{{ route('posts.index') }}" method="GET">
                        @foreach ($tags as $tag)
                        <div>
                            <input onChange="this.form.submit()" type="checkbox" id="{{ $tag->name }}" name="tags[]"
                                value="{{ $tag->name }}"
                                {{ !empty(request()->tags) ? in_array($tag->name, request()->tags) ? 'checked' : '' : ''}}>
                            <label for="{{ $tag->name }}">{{ $tag->name }}</label>
                        </div>
                        @endforeach
                    </form>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

    <div class="col-8 center">

        @can('create', 'App\\Models\Post')
        <div class="row">
            <div class="col">
                <a href="{{ route('posts.create') }}" type="button" class="btn btn-primary">Create new post</a> 
            </div>
        </div>
        @endcan

        @if (session()->has('postDeletion'))
        <div class="row alert alert-success">
            {{ session('postDeletion') }}
        </div>
        @endif

        <div class="row mt-2">
            <div class="col text-center">
                {{ $posts->links() }}
            </div>
        </div>

        @foreach ($posts as $post)
        <div class="row mx-3 mb-3" id="post-wrapper">
            <a href="{{ route("posts.show", $post->id) }}">
                <div class="row post" id="{{ $loop->last ? "" : "post-sep" }}">

                    @php
                    $image = $post->getImage()
                    @endphp

                    <div class="col">
                        <div class="row my-2">
                            @if ($image != NULL)
                            <div class="col-2 p-0 me-2">
                                <img class="img-fluid" src="{{ asset("storage/$image->path") }}">
                            </div>
                            @endif
                            <div class="col">
                                <div class="row">
                                    <h4 class="m-0 p-0">{{ $post->title }}</h4>
                                </div>
                                <div class="row">
                                    {{ $post->upvotes }} likes,
                                    {{ $post->downvotes }} downvotes
                                </div>
                                <div class="row">
                                    {{ $posts->where('id', $post->id)->first()->comments->count() }} comments
                                </div>
                                <div class="row">
                                    @php
                                    $tags = $posts->where('id', $post->id)->first()->tags;
                                    $tag_cnt = $tags->count();
                                    @endphp
                                    @if($tag_cnt > 0)
                                    <span class="p-0 m-0">Tags:
                                        @for ($i = 0; $i < $tag_cnt; $i++) 
                                            @if ($tag_cnt - $i==1)
                                            {{  sprintf('%s', $tags->offsetGet($i)->name)  }} 
                                            @else
                                            {{  sprintf('%s, ', $tags->offsetGet($i)->name)  }} 
                                            @endif 
                                        @endfor
                                    </span> 
                                    @endif
                                </div> 
                            </div> 
                            <div class="col">
                                <div class="row text-end">
                                    <p>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div> 
            </a> 
        </div> 
        @endforeach 
        <div class="row justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>

<div class="col-2 p-0"></div>
</div>
@endsection
