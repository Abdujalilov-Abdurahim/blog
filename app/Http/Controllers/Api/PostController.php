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
        return PostResource::collection(Post::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, PostService $postService)
    {
        return new PostResource($postService->createPost($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Show a specific post by ID
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        // Return the post as a resource
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post, PostService $postService)
    {
        $post = $postService->updatePost($request->validated(), $post);
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, PostService $postService)
    {
    // Check if the post exists
    if (!$post) {
        return response()->json(['message' => 'Post not found'], 404);
    }
    
    $postService->deletePost($post);
        return response()->json(['message' => 'Post deleted successfully'], 200);   
    }
}
