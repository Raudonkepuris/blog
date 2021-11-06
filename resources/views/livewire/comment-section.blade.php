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

            @foreach ($comments->where('parent_id', NULL) as $comment)
            <div class="row pb-2">
                <div class="col">
                    <div class="row border p-1">
                        <div class="col">
                            <div class="row justify-content-between">
                                <div class="col p-0">
                                    <b>{{ $comment->name }}</b>
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
                                <button type="button" wire:click="delete({{ $comment->id }})"
                                    class="btn btn-link p-0 mx-2 text-danger">Delete</button>
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

                    @foreach ($comments->where('parent_id', $comment->id)->sortByDesc('created_at') as $reply)

                    <div class="row">
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
                                        @if (Gate::allows('delete_comments') || in_array($reply->id, session('comments')))
                                        <button type="button" wire:click="delete({{ $reply->id }})"
                                            class="btn btn-link p-0 mx-2 text-danger">Delete</button>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
