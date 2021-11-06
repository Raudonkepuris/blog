<?php

namespace App\Http\Livewire;

use Livewire\Component;
use app\Models\Comment;
use Illuminate\Support\Facades\Gate;

class CommentSection extends Component
{
    public $errors;
    public $comments;
    public $post;
    public $content, $name;
    public $reply_ids=[];

    protected $rules = [
        'name' => 'max:80',
        'content' => 'required|max:65535',
    ];

    protected $listeners = ['commentAdded' => 'render',
                            'commentDeleted' => 'render'];

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

        $this->emit('commentAdded');
    }

    public function openReplyField($id)
    {
        if(in_array($id, $this->reply_ids)){
            $this->reply_ids = array_diff($this->reply_ids, array($id));
        }else{
            array_push($this->reply_ids, $id);
        }
    }

    public function delete($id)
    {
        if(Gate::allows('delete_comments') || in_array($id, session('comments')))
        {
            $comment = $this->comments->find($id);

            if($comment != NULL)
            {
                $comment->replies()->delete();
                $comment->delete();
            } 

            $this->emit('commentDeleted');
        }
    }

    public function render()
    {
        $this->comments = $this->post->comments->sortByDesc('created_at');

        return view('livewire.comment-section');
    }
}
