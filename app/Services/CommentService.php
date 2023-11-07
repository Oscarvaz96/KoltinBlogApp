<?php
namespace App\Services;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class CommentService {

    /**
     * @param mixed
     * @return Comment
     */
    public function create($data) : Comment {
        return Comment::make($data);
    }

}