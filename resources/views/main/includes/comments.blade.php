@php
    use App\Models\PostComment;
    use Illuminate\Support\Str;
    use Carbon\Carbon;
    Carbon::setLocale('ru');
@endphp
<div class="pb-3 comments" id="comments">
    @auth
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
    @endauth
    <div>
        @foreach ($allComments as $comment)
            <div class="group-comments" id="group-{{ $comment['comment']->id }}">
                <div class="m-3">
                    <div class="card">
                        <div class="card-body">
                            <a class="author changeColorLink link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                href="/user/{{ $comment['comment']->user->id }}">{{ $comment['comment']->user->name }}</a>
                            <span class="text-secondary">·</span>
                            <span
                                class="time text-secondary pe-2">{{ Carbon::parse($comment['comment']->created_at)->diffForHumans() }}</span>
                            <p class="card-text">{{ $comment['comment']->content }}</p>
                        </div>
                        <div class="card-footer">
                            <div class="buttons d-flex">
                                <button type="button" class="btn btn-outline-secondary btn-sm me-2 answerButton">
                                    <i class="bi bi-arrow-90deg-left"></i>
                                    Ответить
                                </button>
                                @auth
                                    @if (auth()->user()->id === $comment['comment']->user->id)
                                        <form class="commentRemoveForm">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $comment['comment']->id }}">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($comment['replies'] as $answerComment)
                    <div class="m-3 ps-5">
                        <div class="card">
                            <div class="card-body">
                                <a class="author changeColorLink link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                    href="/user/{{ $answerComment->user->id }}">{{ $answerComment->user->name }}</a>
                                <span class="text-secondary">·</span>
                                <span
                                    class="time text-secondary pe-2">{{ Carbon::parse($answerComment->created_at)->diffForHumans() }}</span>
                                <p class="card-text">{{ $answerComment->content }}</p>
                            </div>
                            <div class="card-footer">
                                <div class="buttons d-flex">
                                    <button type="button" class="btn btn-outline-secondary btn-sm me-2 answerButton">
                                        <i class="bi bi-arrow-90deg-left"></i>
                                        Ответить
                                    </button>
                                    @auth
                                        @if (auth()->user()->id === $answerComment->user->id)
                                            <form class="commentRemoveForm">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $answerComment->id }}">
                                                <button type="submit" class="btn btn-outline-secondary btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
@auth
    <script>
        $(document).ready(function() {
            initializeEvents();
        });
        $(document).on('pjax:end', function() {
            initializeEvents();
        })

        async function initializeEvents() {
            $('.answerButton').off('click').on('click', handleAnswerButtonClick);
            $('.commentForm').off('submit').on('submit', handleCommentFormSubmit);
            $('.commentRemoveForm').off('submit').on('submit', handleCommentRemoveFormSubmit);
            $('.comments').off('change').on('change', initializeEvents);
        }

        async function handleAnswerButtonClick() {
            var groupComments = $(this).closest('.group-comments');
            var answerBlock = groupComments.find('.answerBlock');
            var groupId = groupComments.attr('id').replace(/\D+/, '');
            var replyUser = $(this).closest('.card').find('.author').text();
            var answerFormContent = `
                <div class="m-3 card answerBlock">
                    <div class="card-body">
                        <form class="commentForm">                        
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="reply_id" value="${groupId}">
                            <div class="d-flex align-items-center">
                                <div class="mb-3 flex-fill">
                                    <textarea class="form-control" id="commentTextarea" name="content" style="resize: none;" placeholder="Написать комментарий..." required></textarea>
                                </div>
                                <div class="text-end ms-3">
                                    <button type="submit" class="btn btn-primary mb-3">
                                        <i class="bi bi-send"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>`;

            if (answerBlock.length) {
                answerBlock.replaceWith(answerFormContent);
            } else {
                groupComments.append(answerFormContent);
            }

            $('html, body').animate({
                scrollTop: groupComments.offset().top
            }, 0);

            groupComments.find('textarea.form-control').val(`${replyUser}, `).focus();
            initializeEvents();
        }

        async function handleCommentFormSubmit(event) {
            event.preventDefault();

            const formData = $(this).serialize();

            let response = await fetch(`/post/{{ $post->id }}/comments/send`, {
                method: 'POST',
                body: formData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
            });

            if (response.ok) {
                $.pjax.reload({
                    container: '#comments'
                });
                event.target.reset();
            } else {
                console.log("Ошибка HTTP: " + response.status);
            }
        }

        async function handleCommentRemoveFormSubmit(event) {
            event.preventDefault();

            const formData = $(this).serialize();
            let response = await fetch(`/post/comments/remove`, {
                method: 'POST',
                body: formData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
            });
            if (response.ok) {
                $.pjax.reload(`#comments`);
                event.target.reset();
            } else {
                console.log("Ошибка HTTP: " + response.status);
            }
        }
    </script>
@endauth
