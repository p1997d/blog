<form method="POST" action="{{ route('logout') }}">
    @csrf
    <div class="card" style="width: 280px;">
        <div class="card-body">
            <div class="mb-3 text-center">
                <h5 class="card-title"><a href="/user/{{ auth()->user()->id }}"
                        class="changeColorLink link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{ auth()->user()->name }}</a>
                </h5>
                @if (auth()->user()->role === 1)
                    <span class="badge rounded-pill bg-secondary">Модератор</span>
                @endif
                <div class="d-flex justify-content-evenly pt-3">
                    <span>Постов: {{ $myPostsCount }}</span>
                    <span>Лайков: {{ $myLikesCount }}</span>
                </div>
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-primary w-100 mt-3" data-bs-toggle="modal"
                    data-bs-target="#newPost">
                    <i class="bi bi-plus-lg"></i>
                    Новый пост
                </button>
                <a href="/user/{{ auth()->user()->id }}/liked" type="button" class="btn btn-primary w-100 mt-3">
                    <i class="bi bi-suit-heart-fill"></i>
                    Понравившиеся посты
                </a>
                @if (auth()->user()->role === 1)
                    <a href="/admin" class="btn btn-primary w-100 mt-3"><i class="bi bi-menu-button-wide"></i>
                        Администрирование
                    </a>
                @endif
                <button type="submit" class="btn btn-danger w-100 mt-3"><i class="bi bi-box-arrow-right"></i>
                    Выйти
                </button>
            </div>
        </div>
    </div>
</form>
