<nav class="navbar navbar-expand navbar-light bg-[var(--spotify-gray-bold)] topbar mt-2 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3 bg-[var(--spotify-gray-bold)] text-white">
        <i class="fa fa-bars"></i>
    </button>
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-white small">{{ Auth::user()?->name ?? 'Guest' }}</span>
                    <i class="fas fa-user fa-sm fa-fw text-white"></i>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <form id="logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                    </form>
                    <a class="dropdown-item text-white" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-white"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

</nav>