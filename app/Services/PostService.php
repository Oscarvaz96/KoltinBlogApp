<?php
namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class PostService {

    //NOTE: This looks more like a repository, but it's ok to let it as a service class

    /**
     * @param mixed
     * @return Post
     */
    public function create($data) : Post {
        return Post::make($data);
    }


     /**
     * @return Post
     */
    public function getPostsById($id) : Post {
        return Post::find($id);
    }

}