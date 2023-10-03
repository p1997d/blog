@php
    use App\Models\PostComment;
    use Illuminate\Support\Str;
@endphp
<div class="m-3">
    <div class="card">
        <div class="card-body">
            <form class="commentForm">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <div class="mb-3">
                    <p>Комментарии ({{ PostComment::getCommentsByPost($post->id)->count() }})</p>
                    <textarea class="form-control" id="commentTextarea" name="content" rows="3" style="resize: none;"
                        placeholder="Написать комментарий..." required></textarea>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary mb-3">
                        <i class="bi bi-send"></i>
                        Отправить
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
