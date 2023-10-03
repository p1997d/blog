<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="card" style="width: 280px;">
        <div class="card-body">
            <h5 class="card-title text-center">Войти</h5>
            <div class="mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

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
