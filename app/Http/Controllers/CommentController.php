<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Resources\CommentResource;
use App\Http\Requests\CommentStoreRequest;
use App\Services\CommentService;

class CommentController extends Controller
{
    /**
     * @var CommentService
     */
    protected $commentService;

    public function __construct(
        CommentService $commentService
    )
    {
        $this->commentService = $commentService;
    }

    public function index(Post $post)
    {
        $comments = $post->comments;
        $test = "";
        return CommentResource::collection($comments);
    }

    public function store(CommentStoreRequest $request, Post $post) : CommentResource
    {
        $data = $request->validated();
        $comment = $this->commentService->create($data);
        $comment->post()->associate($post);
        $comment->save();

        return new CommentResource($comment->fresh());
    }
}
