<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Image;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(request()->all());

        // if(request()->has("tags")){ 
        //     dd(request()->only("tags")); 
        // }

         $tags = Tag::all()->where('display');

        // if($request->tag){
        //     $posts = Post::whereHas('tags', function(Builder $query) use($request) {
        //         $query->where('tags.id', $request->tag);
        //     })->paginate(5);
        // }else{
        //     $posts = Post::paginate(10);
        // }

        $posts = Post::when($request->has("tags"), function($query) use($request) {
            $query->whereHas('tags', function(Builder $query) use($request) {
                          $query->whereIn('tags.name', $request->tags);
                      });
        })->orderBy('id', 'desc')->paginate(10);
        
        return view('posts.index', [
            'tags' => $tags,
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        $tags = Tag::all();

        return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $post = new Post;

        $post->title = $request->title;
        $post->content = $request->content;
        $post->upvotes = 0;
        $post->downvotes = 0;

        $post->save();

        $post->tags()->sync($request->tags, false);

        if($request->file('photo') != NULL){
            $path = $request->file('photo')->store('blog-photos', 'public');

            $post->image()->create([
                'path' => $path
            ]);
        }


        return $this->show($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $comments = $post->comments->sortByDesc('created_at');

        $image = Image::whereHasMorph(
            'imageable',
            Post::class,
            function (Builder $query) use($post) {
                $query->where('imageable_id', $post->id);
            }
        )->first();

        return view('posts.post', compact('post', 'comments', 'image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $tags = Tag::all();

        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        // if($request->file('photo') != NULL){
        //     $path = $request->file('photo')->store('blog-photos', 'public');
        //     $post->photo = $path;
        // }

        $post->update([
            'title'=>$request->title,
            'content'=>$request->content,
        ]);

        $post->tags()->sync($request->tags, true);

        $request->session()->flash('updated', 'Post has been updated successfully');

        return $this->show($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Post::find($id));

        
    }
}
