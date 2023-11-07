<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

     protected $fillable = [
        'title', 'content'
    ];

    /**
     *@desc Get the comments for the blog post.
    */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     *@desc Get the author
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
