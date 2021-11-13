    <div class="row justify-content-start mb-4">
        <img wire:click="vote('1')" role="button" style="display:inline" src="{{ asset("$like_src") }}" width="20" alt="">
        <small>{{ $post->upvotes }}</small>
        <img wire:click="vote('2')" role="button" style="display:inline" src="{{ asset("$dislike_src") }}" width="20" alt="">
        <small>{{ $post->downvotes }}</small>
    </div>
