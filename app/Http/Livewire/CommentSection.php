<?php

namespace App\Http\Livewire;

use Livewire\Component;
use app\Models\Comment;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class CommentSection extends Component
{
    use WithPagination;

    public $errors;
    public $post;
    public $content, $name;
    public $reply_ids=[];
    public $deleteId;
    public $replies;
    public $hidden_ids=[];

    public function paginationView()
    {
        return 'vendor.pagination.livewire';
    }

    protected $rules = [
        'name' => 'max:80',
        'content' => 'required|max:65535',
    ];

    public function mount()
    {
        $this->checkHidden();
    }

    public function checkHidden()
    {
        foreach($this->post->comments as $comment){
            if($comment->replies->count() > 5){
                $this->hidden_ids[$comment->id] = 0;
            }
        }
    }

    public function showMoreReplies($id)
    {   
        if($this->hidden_ids[$id] < $this->post->comments->where('id', $id)->first()->replies->count()){
            $this->hidden_ids[$id] += 5;
        }
    }

    public function showLessReplies($id)
    {
        if($this->hidden_ids[$id] != 0){
            $this->hidden_ids[$id] -= 5;
        }
    }

    public function submit($parent_id = null)
    {
        $this->validate();

        $this->name = $this->name == NULL ? 'Anonymous' : $this->name;

        $comment = new Comment;
        $comment->name = $this->name;
        $comment->content = $this->content;
        $comment->parent_id = $parent_id;

        $this->post->comments()->save($comment);

        session()->push('comments', $comment->id);

        session()->flash('message', 'Comment posted.');

        $this->content = "";
    }

    public function openReplyField($id)
    {
        if(in_array($id, $this->reply_ids)){
            $this->reply_ids = array_diff($this->reply_ids, array($id));
        }else{
            array_push($this->reply_ids, $id);
        }
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        if(Gate::allows('delete_comments') || in_array($this->deleteId, session('comments')))
        {
            $comment = Comment::find($this->deleteId);

            if($comment != NULL)
            {
                $comment->replies()->delete();
                $comment->delete();
            } 

            session()->flash('deleted', 'Comment deleted.');
        }
    }

    public function render()
    {
        
        $this->replies = $this->post->replies;

        return view('livewire.comment-section',[ 
            'comments' => Comment::where('commentable_id', $this->post->id)->whereNull('parent_id')->orderByDesc('created_at')->paginate(5),
        ]);
    }
}
