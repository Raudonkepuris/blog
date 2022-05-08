    <div class="row justify-content-start mb-4 mx-1">
        <div class="col-1">
            <img class="img-fluid vote-btn" style="width: 1em" wire:click="vote('1')" role="button" src="{{ asset("$like_src") }}">
            <small>{{ $post->upvotes }}</small>
            
            <img class="img-fluid vote-btn" style="width: 1em" wire:click="vote('2')" role="button" src="{{ asset("$dislike_src") }}">
            <small>{{ $post->downvotes }}</small>
        </div>
            
    </div>
