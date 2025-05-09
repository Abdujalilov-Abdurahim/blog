<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Services\PostService;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {     
        // Return a collection of posts as a resource
        // Paginate the posts
        // Return the paginated posts as a resource collection
        // Use the PostResource to transform the data
        return PostResource::collection(Post::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, PostService $postService)
    {
        // Create a new post
        // Create the post using the PostService
        return new PostResource($postService->createPost($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Return the post as a resource
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post, PostService $postService)
    {
        // Update the post
        $post = $postService->updatePost($request->validated(), $post);
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, PostService $postService)
    {
        // Delete the post
    $postService->deletePost($post);
        return response()->json(['message' => 'Post deleted successfully'], 200);   
    }
}
