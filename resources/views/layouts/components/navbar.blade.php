<style>
    .dropdown-menu {
        right: 0;
        left: auto;
    }
</style>
<nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- Messages Dropdown Menu -->

        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-user"></i> <!-- Icon Profil -->
            </button>
            <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <!-- Profil Dropdown Button -->


    </ul>
</nav>
