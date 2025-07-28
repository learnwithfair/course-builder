<!-- Sidebar -->
<aside class="p-3 main-sidebar border-end vh-100">
    <button id="sidebar-close" class="m-1 top-5 btn btn-light d-sm-none position-fixed end-0 translate-middle-y">
        <i class="fas fa-times"></i>
    </button>
    <div class="brand-link">
        <a href="{{ route('home') }}" class="text-uppercase navbar-brand">Courses +</a>
    </div>
    <nav class="mt-3">
        <ul class="nav flex-column">
            <!-- Dashboard Link -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>

            <!-- Manage Client Link -->
            <li class="nav-item">
                <a href="{{ route('courses.index') }}"
                    class="nav-link {{ request()->routeIs(['courses.index', 'courses.show', 'courses.create', 'courses.store']) ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Courses
                </a>
            </li>

            <!-- Sign Out Button -->
            <li class="nav-item">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="nav-link">
                    <i class="fas fa-sign-out-alt"></i> Sign Out
                </a>
            </li>

            <!-- Logout Form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
    </nav>
</aside>
