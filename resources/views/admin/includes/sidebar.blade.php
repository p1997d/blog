<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <ul class="nav nav-pills nav-sidebar flex-column pt-3" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="/" class="nav-link">
                    <i class="bi bi-house"></i>
                    <p>Главная</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.main.index') }}" class="nav-link">
                    <i class="bi bi-speedometer2"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.category.index') }}" class="nav-link">
                    <i class="bi bi-list"></i>
                    <p>Категории</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.tag.index') }}" class="nav-link">
                    <i class="bi bi-tags"></i>
                    <p>Теги</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.post.index') }}" class="nav-link">
                    <i class="bi bi-postcard"></i>
                    <p>Посты</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.user.index') }}" class="nav-link">
                    <i class="bi bi-people"></i>
                    <p>Пользователи</p>
                </a>
            </li>
        </ul>
    </div>
</aside>
