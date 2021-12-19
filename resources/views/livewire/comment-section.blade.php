<div>
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="row">
                <p>Post your comment</p>
            </div>

            <div class="row">
                @if ($errors->any())
                <div class="col alert alert-danger">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <div class="row">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @elseif (session()->has('deleted'))
                <div class="alert alert-danger">
                    {{ session('deleted') }}
                </div>
                @endif
            </div>
            

            <div class="row">
                <form wire:submit.prevent="submit" style="width: 100%">
                    <div class="form-group">
                        <input wire:model="name" type="text" class="form-control" placeholder="Name (Anonymous)">
                    </div>
                    <div class="form-group">
                        <textarea wire:model.lazy="content" type="text" class="form-control"
                            placeholder="Comment"></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Comment">
                </form>
            </div>

            @foreach ($comments as $comment)
            <div class="row pb-2">
                <div class="col">
                    <div class="row border p-1">
                        <div class="col">
                            <div class="row justify-content-between">
                                <div class="col p-0">
                                    <b>{{ $comment->name }}</b>
                                    @if (in_array($comment->id, $this->hidden_ids) == true ? 'd-none' : '' )
                                    {{ $comment->id }}
                                    @endif
                                </div>
                                <div class="col p-0 text-align-end">
                                    <p class="text-right">Posted {{ $comment->updated_at->diffforhumans() }}</p>
                                </div>

                            </div>
                            <div class="row">
                                <p>{{ $comment->content }}</p>
                            </div>
                            <div class="row">

                                <button type="button" wire:click="openReplyField({{ $comment->id }})"
                                    class="btn btn-link p-0 mx-2">Reply</button>

                                @if (session('comments') != NULL || Gate::allows('delete_comments'))
                                @if (Gate::allows('delete_comments') || in_array($comment->id, session('comments')))
                                    <button type="button" wire:click="deleteId({{ $comment->id }})" 
                                        class="btn btn-link text-danger" data-toggle="modal" data-target="#commentModal">Delete</button>
                                @endif
                                @endif

                            </div>
                        </div>
                    </div>
                    @if ($reply_ids != NULL)
                    @if(in_array($comment->id, $reply_ids))
                    <div class="row">
                        <form wire:submit.prevent="submit({{ $comment->id }})" style="width: 100%">
                            <div class="form-group">
                                <input wire:model="name" type="text" class="form-control"
                                    placeholder="Name (Anonymous)">
                            </div>
                            <div class="form-group">
                                <textarea wire:model.lazy="content" type="text" class="form-control"
                                    placeholder="Comment"></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Comment">

                        </form>
                    </div>
                    @endif
                    @endif
                    
                    @if (array_key_exists($comment->id,$hidden_ids))
                        <div class="row {{ $hidden_ids[$comment->id] == 0 ? 'd-none' : '' }}">
                            <button type="button" wire:click="showLessReplies({{ $comment->id }})"
                                class="btn btn-link p-0 mx-2">Show less replies</button>
                        </div>
                    @endif

                    @php
                    $i = 0
                    @endphp
                    @foreach ($replies->where('parent_id', $comment->id) as $reply)


                    @if (array_key_exists($comment->id,$hidden_ids))
                    @php
                    if ($i >= $hidden_ids[$comment->id]) break;
                    $i++;
                    @endphp
@endif
                    <div class="row {{ array_key_exists($comment->id,$hidden_ids) && $hidden_ids[$comment->id] == 0 ? 'd-none' : '' }}">
                        <div class="col-1">

                        </div>
                        <div class="col-11">
                            <div class="row border p-1">
                                <div class="col">
                                    <div class="row justify-content-between">

                                        <div class="col p-0">
                                            <b>{{ $reply->name }}</b>
                                        </div>
                                        <div class="col p-0 text-align-end">
                                            <p class="text-right">Posted {{ $reply->updated_at->diffforhumans() }}
                                            </p>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <p>{{ $reply->content }}</p>
                                    </div>
                                    <div class="row">
                                        @if (session('comments') != NULL || Gate::allows('delete_comments'))
                                        @if (Gate::allows('delete_comments') || in_array($reply->id,
                                        session('comments')))
                                            <button type="button" wire:click="deleteId({{ $reply->id }})" 
                                             class="btn btn-link text-danger" data-toggle="modal" data-target="#commentModal">Delete</button>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if (array_key_exists($comment->id,$hidden_ids))
                    <div class="row {{ $hidden_ids[$comment->id] < $comment->replies->count() ? '' : 'd-none' }}">
                        <button type="button" wire:click="showMoreReplies({{ $comment->id }})"
                            class="btn btn-link p-0 mx-2">Show more replies
                            ({{ $comment->replies->count()-$hidden_ids[$comment->id] }})</button>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
            <div class="row justify-content-center">
                {{ $comments->links('vendor.pagination.bootstrap-4-livewire') }}
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentModalLabel">Delete Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>

               <div class="modal-body">
                    <p>Are you sure want to delete this comment?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>

</div>
