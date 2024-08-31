<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Distribusi Barang Bunga Coklat">
    <meta name="keywords" content="Sistem Informasi, Distribusi Barang, Bunga Coklat">

    <title>Bunga Coklat | Sistem Informasi Distribusi Barang</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon bunga coklat.png') }}">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    
    <!-- Font family -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    <!-- Feather CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">
    
    <!-- Datatables CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
    
    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        .navbar-shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
    
    <!-- Layout JS -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
</head>
<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <header class="navbar navbar-light bg-light navbar-expand fixed-top navbar-shadow">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <img src="{{ Auth::guard('sales')->user()->foto; }}" alt="User Photo" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                    <span class="ms-2 fw-bold">{{ Auth::guard('sales')->user()->nama_sales; }}</span>
                </div>
                <a href="{{ route('logout-user') }}" class="btn btn-import ms-auto me-2"><i class="fe fe-power"></i> Logout</a>
            </div>
        </header>
        <!-- /Header -->
		<br><br><br>
        <!-- Page Wrapper -->
        <div class="content container-fluid">
            @yield('content-user')
        </div>          
        <!-- /Page Wrapper -->
        <br><br><br>
        <!-- Bottom Navbar -->
        <nav class="navbar navbar-light bg-light navbar-expand fixed-bottom navbar-shadow">
            <div class="container-fluid">
                <ul class="navbar-nav nav-justified w-100">
                    <li class="nav-item">
                        <a class="nav-link text-center" href="{{ route('toko-sales') }}">
                            <i class="fe fe-home"></i><br>Toko
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" href="{{ route('kunjungan') }}">
                            <i class="fe fe-shopping-cart"></i><br>Kunjungan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" href="{{ route('profile') }}">
                            <i class="fe fe-user"></i><br>Profile
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /Bottom Navbar -->
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>

    <!-- Bootstrap Bundle JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
