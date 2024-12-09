<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inventory Barang</title>

    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('templates/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('templates/dist/css/adminlte.min.css') }}">
    <!-- css custom-->
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">

    {{-- bootsrap css --}}

    {{-- Bootsrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tambahkan SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-mini">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">

    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.components.navbar')
        <!-- /.navbar -->

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <dotlottie-player src="https://lottie.host/d92c7ea6-7bfa-4858-854d-103e5b1a89c6/Nfv68QNNF5.lottie"
                background="transparent" speed="3" style="width: 300px; height: 300px" loop autoplay>
            </dotlottie-player>
        </div>

        <!-- Main Sidebar Container -->
        @include('layouts.components.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    @yield('header')
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- /.content -->

            <a id="back-to-top" href="#" class="btn btn-tambah back-to-top" role="button"
                aria-label="Scroll to top">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
        <!-- /.content-wrapper -->



        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('templates/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('templates/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('templates/dist/js/adminlte.min.js') }}"></script>

    <!-- Bootstrap CSS -->
    <!-- Bootstrap JS (untuk modal dan interaktivitas lainnya) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



    <!-- Tambahkan JavaScript lainnya di sini -->
</body>

</html>
