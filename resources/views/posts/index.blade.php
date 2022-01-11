@extends('layouts.app')
@section('title', 'Posts')

@section('style')
<style>
    #post-sep {
        border-bottom: 2px solid #ddd;
    }

    .post {
        padding: 10px 0px;
    }


    .col {
        color: #ddd;
    }

    .title {
        color: goldenrod;
    }

    .tags {
        border-radius: 10px;
        background-color: #333;
        /* font-size: 1.1em; */
        color: lightblue;
    }

    .tags .row {
        margin: 5px;
    }

    .tags .row p {
        margin-top: 10px;
        font-size: 1.1em;
    }

    .button {
        padding: 10px;
        color: #ddd;
        background-color: #333;
        border: #ddd 2px solid;
        border-radius: 10px;
        text-decoration: none;
    }

    .button:hover {
        text-decoration: none;
        color: lightblue;
        border-color: lightblue;
        background-color: #111;
    }

</style>
@endsection

@section('content')

<div class="row justify-content-center" id="main">
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
                        {{-- <input class="btn btn-primary" type="submit" value="Submit"> --}}
                    </form>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    <div class="col-8" id="center">

        <div class="row">
            @can('create', 'App\\Models\Post')
            <a href="{{ route('posts.create') }}" type="button" class="btn btn-primary">Create new post</a>
            @endcan
        </div>

        @if (session()->has('postDeletion'))
        <div class="alert alert-success">
            {{ session('postDeletion') }}
        </div>
        @endif


        <div class="row justify-content-center">
            {{ $posts->links() }}
        </div>

        @foreach ($posts as $post)
        <a href="{{ route("posts.show", $post->id) }}" style="text-decoration: none;">
            <div class="row post" id="{{ $loop->last ? "" : "post-sep" }}">

                <div class="col">
                    <div class="row">
                        <div class="col title">
                            <h4>{{ $post->title }}</h4>
                        </div>
                        <div class="col text-right">
                            {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
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

                    @php
                        $tags = $posts->where('id', $post->id)->first()->tags;
                        $tag_cnt = $tags->count();
                    @endphp
                    @if($tag_cnt > 0)
                    <div class="row">
                        <div class="col">
                            <span>Tags:
                                @for ($i = 0; $i < $tag_cnt; $i++) 
                                    @if ($tag_cnt - $i==1)
                                    {{  sprintf('%s', $tags->offsetGet($i)->name)  }} 
                                    @else
                                    {{  sprintf('%s, ', $tags->offsetGet($i)->name)  }} 
                                    @endif
                                @endfor 
                            </span> 
                        </div>
                    </div> 
                    @endif

                </div>
            </div>
        </a>
        @endforeach

        <div class="row justify-content-center">
            {{ $posts->links() }}
        </div>

    </div>
    <div class="col-2 p-0"></div>
</div>

@endsection
