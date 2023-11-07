<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Exception;

class PostController extends Controller
{
    /**
     * @var PostService
     */
    protected $postService;

    public function __construct(
        PostService $postService
    )
    {
        $this->postService = $postService;
    }

    public function index()
    {
        return PostResource::collection(Post::all());
    }

   
    public function store (PostStoreRequest $request) : PostResource
    {
        try{
            $data = $request->validated();
            $user = request()->user();
            $post = $this->postService->create($data);
            $post->author()->associate($user);
            $post->save();
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }

        return new PostResource($post->fresh());
    }

    public function show($post_id) : PostResource
    {
        $post = $this->postService->getPostsById($post_id);
        return new PostResource($post);
    }
}
