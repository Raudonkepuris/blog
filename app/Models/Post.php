<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tags(){
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable')->where('parent_id', NULL);
    }

    public function replies()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNotNull('parent_id');
    }
}
