@auth
    <div class="d-flex flex-column flex-shrink-0 p-3 align-items-stretch flex-fill">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="card" style="width: 280px;">
                <div class="card-body">
                    <div class="mb-3 text-center">
                        <h5 class="card-title"><a href="/user/{{ auth()->user()->id }}"
                                class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{ auth()->user()->name }}</a>
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
    </div>
@else
    <div class="d-flex flex-column flex-shrink-0 p-3 align-items-stretch flex-fill">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="card" style="width: 280px;">
                <div class="card-body">
                    <h5 class="card-title text-center">Войти</h5>
                    <div class="mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="Пароль">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100 mt-3">Войти</button>
                        <button type="button" class="btn btn-secondary w-100 mt-3" data-bs-toggle="modal"
                            data-bs-target="#registerModal">
                            Зарегистрироваться
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endauth
