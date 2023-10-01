@php
    use App\Models\PostComment;
    use Illuminate\Support\Str;
    use Carbon\Carbon;
    Carbon::setLocale('ru');
@endphp
<div class="card m-3">
    <div class="card-header">
        <a class="author link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover changeColorLink"
            href="/user/{{ $post->user->id }}">{{ $post->user->name }}</a>
        <span class="text-secondary">·</span>
        <span class="time text-secondary pe-2">{{ Carbon::parse($post->created_at)->diffForHumans() }}</span>
        <h5 class="card-title">
            <a href="/post/{{ $post->id }}"
                class="link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover changeColorLink">
                {{ $post->title }}
            </a>
        </h5>
    </div>
    <div class="card-body position-relative overflow-hidden">
        @if (Route::currentRouteName() === 'main.post')
            <div class="card-text z-1 overflow-hidden">{!! $post->content !!}</div>
        @else
            <div class="card-text z-1 overflow-hidden" style="max-height: 400px;">{!! $post->content !!}</div>
            <div class="card-gradient w-100 h-50 position-absolute z-2"
                style="bottom: 10%; background: linear-gradient(to bottom, transparent 50%, var(--bs-body-bg) 90%);">
            </div>
            <a href="/post/{{ $post->id }}" class="card-button btn btn-primary btn-sm position-relative z-3">Читать далее</a>
        @endif
    </div>
    <div class="card-footer text-body-secondary">
        <div class="tags">
            @foreach ($post->tags as $tag)
                <span class="badge text-bg-secondary">{{ $tag->title }}</span>
            @endforeach
        </div>
        <br>
        <div class="buttons" id="buttons{{ $post->id }}">
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                <button type="button" class="btn btn-{{ $post->getDislikeByUser() ? '' : 'outline-' }}danger"
                    onclick="setRating('dislike', {{ $post->id }})"><i class="bi bi-caret-down"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary" disabled>{{ $post->rating }}</button>
                <button type="button" class="btn btn-{{ $post->getLikeByUser() ? '' : 'outline-' }}success"
                    onclick="setRating('like', {{ $post->id }})">
                    <i class="bi bi-caret-up"></i>
                </button>
            </div>
            <button type="button" class="btn btn-outline-secondary btn-sm" disabled>
                <i class="bi bi-eye"></i>
                {{ $post->view }}
            </button>
            <a type="button" class="btn btn-outline-secondary btn-sm" href="/post/{{ $post->id }}#comments">
                <i class="bi bi-chat-left"></i>
                {{ PostComment::getCommentsByPost($post->id)->count() }}
            </a>
            @auth
                @if (Route::currentRouteName() === 'main.post' && auth()->user()->id === $post->user->id)
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#editPost">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('main.post.remove', $post->id) }}">
                        <i class="bi bi-trash"></i>
                    </a>
                @endif
            @endauth
        </div>
    </div>
</div>
