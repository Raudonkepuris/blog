<div>
    <div class="row">
        @can('update', $post)
        <a wire:click="toggleEditing" type="button" class="btn btn-primary m-1">Edit</a>
        @endcan
        @can('delete', $post)
        <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#postModal">Delete</button>
        @endcan
    </div>

    <div class="col p-0 m-0 {{ $editing == true ? 'd-none' : '' }}">
        <div class="row">
            <h1>{{ $post->title }}</h1>
        </div>

        <div class="row">
            <p>{{ $post->content }}</p>
        </div>
    </div>

    <div class="col p-0 m-0 {{ $editing == false ? 'd-none' : '' }}">
        <div class="row">
        <form wire:submit.prevent="updatePost" class="w-100">
            <div class="form-group">
                <input wire:model="title" class="form-control">
              </div>
            <div class="form-group">
              <textarea wire:model="content" class="form-control" rows="3"></textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Update">
          </form>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="postModal" tabindex="-1" role="dialog"
        aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel">Delete Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this post?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"
                        data-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
