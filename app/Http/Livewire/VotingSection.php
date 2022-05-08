<?php

namespace App\Http\Livewire;

use Livewire\Component;

class VotingSection extends Component
{
    public $post;
    public $like_src, $dislike_src;

    public function vote($act)
    {
        if(session(sprintf("post-%s", $this->post->id)) == 1 && $act == 1){ //when the post is already liked and user is pressing like button second time
            session([sprintf("post-%s", $this->post->id) => 0]);
            $this->post->upvotes = $this->post->upvotes - 1;
        }
        else if(session(sprintf("post-%s", $this->post->id)) == 1 && $act == 2){ //when post is liked but user is pressing dislike
            session([sprintf("post-%s", $this->post->id) => 2]);
            $this->post->downvotes = $this->post->downvotes + 1;
            $this->post->upvotes = $this->post->upvotes - 1;
        }
        else if(session(sprintf("post-%s", $this->post->id)) == 2 && $act == 2){ //when the post is already disliked and user is pressing dislike button second time
            session([sprintf("post-%s", $this->post->id) => 0]);
            $this->post->downvotes = $this->post->downvotes - 1;
        }
        else if(session(sprintf("post-%s", $this->post->id)) == 2 && $act == 1){ //when the post is disliked but user is pressing like
            session([sprintf("post-%s", $this->post->id) => 1]);
            $this->post->downvotes = $this->post->downvotes - 1;
            $this->post->upvotes = $this->post->upvotes + 1;
        }
        else if(session(sprintf("post-%s", $this->post->id)) == 0 && $act == 1){ //user is liking the post 1st time
            session([sprintf("post-%s", $this->post->id) => 1]);
            $this->post->upvotes = $this->post->upvotes + 1;
        }
        else if(session(sprintf("post-%s", $this->post->id)) == 0 && $act == 2){ //user is disliking the post 1st time
            session([sprintf("post-%s", $this->post->id) => 2]);
            $this->post->downvotes = $this->post->downvotes + 1;
        }

        $this->post->save();
    }
    
    public function render()
    {
        if(session(sprintf("post-%s", $this->post->id)) == 1)
        {
            $this->like_src="assets/thumbsup-pressed.png";
            $this->dislike_src="assets/thumbsdown.png";
        }
        else if(session(sprintf("post-%s", $this->post->id)) == 2)
        {
            $this->like_src="assets/thumbsup.png";
            $this->dislike_src="assets/thumbsdown-pressed.png";
        }
        else
        {
            $this->like_src="assets/thumbsup.png";
            $this->dislike_src="assets/thumbsdown.png";
        }

        return view('livewire.voting-section');
    }
}
