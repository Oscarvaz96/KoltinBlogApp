<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'api_token' => $this->api_token,
            'posts' => $this->when(!empty($this->posts),$this->toArrayPostsAndComments($this->posts)),
        ];
    }

     /**
     * Add collection comments to posts.
     *
     * @param  \Collection
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    protected function toArrayPostsAndComments($posts){
        
        $data = $posts->map(function($post){
           return $post->load('comments');
        });

        return $data;
    }
}
