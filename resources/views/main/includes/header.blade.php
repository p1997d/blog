@if (!isset($query))
    {{ $query = null }}
@endif
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Блог</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <form class="d-flex ms-auto mb-2 mb-lg-0" role="search" action="/search">
            <input name="query" class="form-control me-2" type="search" placeholder="Поиск" aria-label="Search"
                value="{{ $query }}">
            <button class="btn btn-outline-success" type="submit">Поиск</button>
        </form>
        <button class="btn ms-2" id="btnSwitch"><i class="bi bi-sun-fill"></i></button>
    </div>
</nav>
