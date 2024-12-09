@php
    $menus = [
        (object) [
            'title' => 'Dashboard',
            'path' => 'dashboard',
            'icon' => 'fa-solid fa-house',
        ],
        (object) [
            'title' => 'Barang',
            'path' => 'products',
            'icon' => 'fa-solid fa-box',
        ],
        (object) [
            'title' => 'Kategori',
            'path' => 'categories',
            'icon' => 'fa-solid fa-table-list',
        ],
        (object) [
            'title' => 'Supplier',
            'path' => 'suppliers',
            'icon' => 'fa-solid fa-user-astronaut',
        ],
        (object) [
            'title' => 'Barang Masuk',
            'path' => 'brgmasuks',
            'icon' => 'fa-solid fa-truck',
        ],
        (object) [
            'title' => 'Barang Keluar',
            'path' => 'brgkeluars',
            'icon' => 'fa-solid fa-truck-ramp-box',
        ],
        (object) [
            'title' => 'Laporan Barang',
            'path' => 'laporans',
            'icon' => 'fas fa-file-pdf',
        ],
    ];
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">
    <script src="https://kit.fontawesome.com/b61a43e08f.js" crossorigin="anonymous"></script>
    <!-- Brand Logo -->
    <a href="templates/index3.html" class="brand-link">
        <img src="{{ asset('images/logo.gif') }}" class="img-fluid d-block mx-auto"
            style="max-width: 100%; height: auto; display: block;" alt="AdminLTE Logo">
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="height: 100vh; overflow-y: auto;"">
        <!-- Sidebar user panel (optional) -->

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @foreach ($menus as $menu)
                    <li class="nav-item">
                        <a href={{ $menu->path[0] !== '/' ? '/' . $menu->path : $menu->path }}
                            class="nav-link {{ Request::is($menu->path) ? 'active' : '' }}"
                            style="{{ Request::is($menu->path) ? 'background-color: #dbeb04; color: black;' : '' }}">
                            <i class="nav-icon {{ $menu->icon }}"></i>
                            <p>
                                {{ $menu->title }}
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
