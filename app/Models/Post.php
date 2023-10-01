<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $quarde = false;
    protected $guarded = [];

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'author',
        'created_at',
        'updated_at',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'author');
    }
    public static function countByUser($userId)
    {
        $post = new static();
        return $post->where('author', $userId)->count();
    }
    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_likes', 'post_id', 'user_id');
    }
    public function dislikes()
    {
        return $this->belongsToMany(User::class, 'post_dislikes', 'post_id', 'user_id');
    }
    public function getLikeByUser()
    {
        if (!Auth::guest()) {
            $data = !$this->likes->where('id', auth()->user()->id)->isEmpty();
        } else {
            $data = null;
        }
        return $data;
    }
    public function getDislikeByUser()
    {
        if (!Auth::guest()) {
            $data = !$this->dislikes->where('id', auth()->user()->id)->isEmpty();
        } else {
            $data = null;
        }
        return $data;
    }
}