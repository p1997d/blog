<div class="modal fade" id="newPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('main.post.store') }}" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Созадть пост</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="title" class="form-control" placeholder="Название"
                            value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <textarea id="newEditor" name="content">
                            {{ old('content') }}
                        </textarea>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="category_id" id="pet-select">
                            <option selected disabled>Выбери категорию</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select class="selectTags w-100" name="tag_ids[]" multiple="multiple">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    {{ is_array(old('tag_ids')) && in_array($tag->id, old('tag_ids')) ? 'selected' : '' }}>
                                    {{ $tag->title }}</option>
                            @endforeach
                        </select>
                        @error('tag_ids')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Созадть</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('main.post.update', $post->id) }}" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Редактировать пост</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="title" class="form-control" placeholder="Название"
                            value="{{ $post->title }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <textarea id="editEditor" name="content">
                            {{ $post->content }}
                        </textarea>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="category_id" id="pet-select">
                            <option disabled>Выбери категорию</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id === $post->category_id ? 'selected' : '' }}>
                                    {{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select class="selectTags w-100" name="tag_ids[]" multiple="multiple">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $tag->title }}</option>
                            @endforeach
                        </select>
                        @error('tag_ids')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Редактировать</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="POST" action="{{ route('register') }}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Регистрация</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Имя') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-end">{{ __('Email Адрес') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm"
                            class="col-md-4 col-form-label text-md-end">{{ __('Подтверждение пароля') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">{{ __('Зарегистрироваться') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
