<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    use HasFactory;

    protected $table = 'post_likes';
    protected $quarde = false;
    protected $guarded = [];

    public static function getLikeByUser($userId)
    {
        $like = new static();
        return $like->where('user_id', $userId);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}