<?php

namespace App\Http\Services\PostService;

use App\Models\Post;


class PostService
{
    public function createPost(array $data)
    {
        return Post::create($data);
    }

    public function updatePost(array $data, Post $post)
    {
        $post->update($data);
        return $post;
    }

    public function deletePost(Post $post)
    {
        return $post->delete();
    }



}