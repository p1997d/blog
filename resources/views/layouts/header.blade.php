@if (!isset($query))
    {{ $query = null }}
@endif

<header class="navbar-expand-lg bg-body-tertiary p-3">
    <div class="d-flex align-items-center justify-content-between">
        <div class="navbar-toggler">
        <button class="btn increasing-on-resize changeColorButton" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
            aria-controls="offcanvasExample" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
        </button>
        </div>
        <a class="navbar-brand mb-0 increasing-on-resize fs-4" href="/">Блог</a>
        <form class="d-none ms-auto d-lg-flex" role="search" action="/search">
            <input name="query" class="form-control me-2 mb-0" type="search" placeholder="Поиск" aria-label="Search"
                value="{{ $query }}">
        </form>
        <button class="btn ms-2 changeColorButton increasing-on-resize" id="btnSwitch"><i class="bi bi-sun-fill"></i></button>
    </div>
</header>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="d-flex flex-column mb-3 align-items-center justify-content-between h-100">
        <div class="py-3 fs-4">
            <div class="py-3">
                @include('main.login.index')
            </div>
            <div class="py-3">
                @include('main.categories.index')
            </div>
        </div>
        <div class="py-3">
            <form class="d-flex ms-auto" role="search" action="/search">
                <input name="query" class="form-control form-control-lg me-2" type="search" placeholder="Поиск" aria-label="Search"
                    value="{{ $query }}">
            </form>
        </div>
    </div>
</div>
