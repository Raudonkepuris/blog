<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Post extends Component
{
    use AuthorizesRequests;

    public $post;
    public $editing = false;

    public $title;
    public $content;

    public function mount($post){
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
    }

    protected $rules = [
        'title' => 'required|max:255',
        'content' => 'required|max:65535',
    ];

    public function updatePost()
    {
        $this->authorize('update', $this->post);

        $this->post->update([
            'title'=>$this->title,
            'content'=>$this->content,
        ]);

        $this->toggleEditing();
    }

    public function toggleEditing()
    {
        $this->authorize('update', $this->post);
        $this->editing = $this->editing == false ? true : false;
    }

    public function delete(){
        $this->authorize('delete', $this->post);

        if($this->post != NULL)
        {
            $this->post->comments()->delete();
            $this->post->tags()->detach();
            $this->post->delete();

            session()->flash('postDeletion', sprintf("Post \"%s\" has been deleted successfully", $this->post->title));

            return redirect()->route('posts.index')->with('status', 'Profile updated!');
        } 
    }

    public function render()
    {
        return view('livewire.post');
    }
}
