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

    /**
     * Получает запрос на выборку записей лайков, сделанных указанным пользователем.
     *
     * @param int $userId Идентификатор пользователя, для которого необходимо получить лайки.
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getLikeByUser($userId)
    {
        $like = new static();
        return $like->where('user_id', $userId);
    }

    /**
     * Определяет отношение между этой моделью и моделью User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Определяет отношение между этой моделью и моделью Post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
