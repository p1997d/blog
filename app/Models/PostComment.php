<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;

    protected $table = 'post_comments';
    protected $quarde = false;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getCommentsByPost($postId)
    {
        $post = new static();
        return $post->where('post_id', $postId);
    }
}