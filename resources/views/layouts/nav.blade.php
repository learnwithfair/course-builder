<!-- Navbar -->
<nav class="navbar navbar-expand-lg text-light">
    <div class="container-fluid">
        <button id="sidebar-toggle" class="btn btn-light d-sm-none me-2">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar Content -->
        <div class="d-flex align-items-center ms-auto">
            <!-- User Profile Dropdown -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-light text-decoration-none dropdown-toggle"
                    id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('assets/images/admin.png') }}" alt="User Image" class="rounded-circle"
                        width="40" height="40">
                    <span class="ms-2 text-capitalize">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
