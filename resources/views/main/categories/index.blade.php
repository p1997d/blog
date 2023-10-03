<ul class="nav nav-pills flex-column mb-auto" style="width: 280px;">
    <li class="nav-item">
        <a href="/" class="nav-link changeColorText {{ Request::is('/') ? 'active' : '' }}" aria-current="page">
            Все потоки
        </a>
    </li>
    @foreach ($categories as $category)
        <li>
            <a href="/category/{{ $category->title }}"
                class="nav-link changeColorText {{ Request::is('category/' . $category->title) ? 'active' : '' }}">
                {{ $category->title }}
            </a>
        </li>
    @endforeach
</ul>
