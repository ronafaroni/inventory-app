<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light"  data-sidebar-size="lg" data-sidebar-image="none">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistem Informasi Distribusi Barang Bunga Coklat">
        <meta name="keywords" content="Sistem Informasi, Distribusi Barang, Bunga Coklat">

		<title>Bunga Coklat | Sistem Informasi Distribusi Barang</title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="{{asset('assets/img/favicon bunga coklat.png') }}">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
        
        <!-- Font family -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">

		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">

		<!-- Feather CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/feather/feather.css')}}">
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
		
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/flatpickr/flatpickr.min.css')}}">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

		<!-- Layout JS -->
		<script src="{{asset('assets/js/layout.js')}}"></script>

	</head>
	<body>
	
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
			<div class="header header-one">

				<a href="index.html"  class="d-inline-flex d-sm-inline-flex align-items-center d-md-inline-flex d-lg-none align-items-center device-logo">
					<img src="{{ asset('assets/img/logo bunga coklat.png') }}" class="img-fluid logo2" alt="Logo">
			   </a>
			   <div class="main-logo d-inline float-start d-lg-flex align-items-center d-none d-sm-none d-md-none">
				   <div class="logo-white">
					   <a href="index.html">
						   <img src="{{ asset('assets/img/logo bunga coklat.png') }}" class="img-fluid logo-blue" alt="Logo">
					   </a>
					   <a href="index.html">
						   <img src="{{ asset('assets/img/logo-small.png') }}" class="img-fluid logo-small" alt="Logo">
					   </a>
				   </div>
				   <div class="logo-color">
					   <a href="index.html">
						   <img src="{{ asset('assets/img/logo bunga coklat.png') }}" class="img-fluid logo-blue" alt="Logo">
					   </a>
					   <a href="index.html">
						   <img src="{{ asset('assets/img/logo-small.png') }}" class="img-fluid logo-small" alt="Logo">
					   </a>
				   </div>
			   </div>
				
				<!-- Mobile Menu Toggle -->
				<a class="mobile_btn" id="mobile_btn">
					<i class="fas fa-bars"></i>
				</a>
				<!-- /Mobile Menu Toggle -->
				
				<!-- Header Menu -->
				<ul class="nav nav-tabs user-menu">
					
					<li class="nav-item  has-arrow dropdown-heads ">
                        <a href="javascript:void(0);" class="win-maximize">
                            <i class="fe fe-maximize"></i>
                        </a>
                    </li>
					<!-- User Menu -->
					<li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="user-link  nav-link" data-bs-toggle="dropdown">
                            <span class="user-img">
                                <img src="{{ asset('assets/img/user.jpg') }}" alt="img" class="profilesidebar">
                                <span class="animate-circle"></span>
                            </span>
                            <span class="user-content">
                                <span class="user-details">{{ Auth::user()->username }}</span>
								<span class="user-name">{{ Auth::user()->name }}</span>
                            </span>
                        </a>
                        <div class="dropdown-menu menu-drop-user">
                            <div class="profilemenu">
                                <div class="subscription-menu">
                                    <ul>
                                        <li>
                                            <a class="dropdown-item" href="profile.html">Profile</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="settings.html">Settings</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="subscription-logout">
                                    <ul>
                                        <li class="pb-0">
											<a class="dropdown-item" href="login.html">Log Out</a>
										</li>
									</ul>
                                </div>
                            </div>
                        </div>
                    </li>
					<!-- /User Menu -->
					
				</ul>
				
				<!-- /Header Menu -->
				
			</div>
			<!-- /Header -->
			
			<!-- Sidebar -->
			<div class="sidebar" id="sidebar">
				<div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<nav class="greedys sidebar-horizantal">
							<ul class="list-inline-item list-unstyled links">
								<li class="menu-title"><span>Main Menu</span></li>
							<li>
								<a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fe fe-home"></i> <span> Dashboard</span></a>
							</li>
							<li class="submenu">
								<a><i class="fe fe-package"></i> <span> Stok Barang</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('daftar-item') }}" class="{{ request()->routeIs('daftar-item') ? 'active' : '' }}">Daftar Item</a></li>
									<li><a href="{{ route('stok-barang') }}" class="{{ request()->routeIs('stok-barang') ? 'active' : '' }}">Stok Tersedia</a></li>
									<li><a href="{{ route('tambah-stok') }}" class="{{ request()->routeIs('tambah-stok') ? 'active' : '' }}">Tambah Stok</a></li>
									<li><a href="{{ route('riwayat-stok') }}" class="{{ request()->routeIs('riwayat-stok') ? 'active' : '' }}">Riwayat Stok</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a><i class="fe fe-users"></i> <span> Sales</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a href="{{ route('daftar-sales') }}" class="{{ request()->routeIs('daftar-sales') ? 'active' : '' }}">Daftar Sales</a></li>
									<li><a href="{{ route('stok-sales') }}" class="{{ request()->routeIs('stok-sales') ? 'active' : '' }}">Stok Sales</a></li>
									<li><a href="{{ route('tambah-stok-sales') }}" class="{{ request()->routeIs('tambah-stok-sales') ? 'active' : '' }}">Tambah Stok Sales</a></li>
									<li><a href="{{ route('riwayat-sales') }}" class="{{ request()->routeIs('riwayat-sales') ? 'active' : '' }}">Riwayat Stok Sales</a></li>
									<li><a href="{{ route('return-stok') }}" class="{{ request()->routeIs('return-stok') ? 'active' : '' }}">Return Stok</a></li>
									<li><a href="{{ route('target-sales')}}" class="{{ request()->routeIs('target_sales') ? 'active' : '' }}">Target Sales</a></a></li>
								</ul>
							</li>
							<li>
								<a href="{{ route('daftar-toko') }}" class="{{ request()->routeIs('daftar-toko') ? 'active' : '' }}"><i class="fe fe-shopping-cart"></i> <span> Toko</span></a>
							</li>
							<li class="submenu">
								<a><i class="fe fe-shopping-bag"></i> <span> Transaksi</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('harga') }}" class="{{ request()->routeIs('harga') ? 'active' : '' }}">Harga & Diskon</a></li>
									<li><a href="{{ route('faktur-terima-barang') }}" class="{{ request()->routeIs('faktur-terima-barang') ? 'active' : '' }}">Faktur Terima Barang</a></li>
									<li><a href="{{ route('faktur-pembayaran') }}" class="{{ request()->routeIs('faktur-pembayaran') ? 'active' : '' }}">Faktur Pembayaran</a></li>
								</ul>
							</li>

							<!-- Settings -->
							<li class="menu-title"><span>Settings</span></li>							
							<li>
								<a href="{{ route('logout') }}"><i class="fe fe-power"></i> <span>Logout</span></a>
							</li>
							</ul>
							<!-- /Settings -->
						</nav>

						<ul class="sidebar-vertical">
							<li class="menu-title"><span>Main Menu</span></li>
							<li>
								<a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fe fe-home"></i> <span> Dashboard</span></a>
							</li>
							<li class="submenu">
								<a><i class="fe fe-package"></i> <span> Stok Barang</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('daftar-item') }}" class="{{ request()->routeIs('daftar-item') ? 'active' : '' }}">Daftar Item</a></li>
									<li><a href="{{ route('stok-barang') }}" class="{{ request()->routeIs('stok-barang') ? 'active' : '' }}">Stok Tersedia</a></li>
									<li><a href="{{ route('tambah-stok') }}" class="{{ request()->routeIs('tambah-stok') ? 'active' : '' }}">Tambah Stok</a></li>
									<li><a href="{{ route('riwayat-stok') }}" class="{{ request()->routeIs('riwayat-stok') ? 'active' : '' }}">Riwayat Stok</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a><i class="fe fe-users"></i> <span> Sales</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a href="{{ route('daftar-sales') }}" class="{{ request()->routeIs('daftar-sales') ? 'active' : '' }}">Daftar Sales</a></li>
									<li><a href="{{ route('stok-sales') }}" class="{{ request()->routeIs('stok-sales') ? 'active' : '' }}">Stok Sales</a></li>
									<li><a href="{{ route('tambah-stok-sales') }}" class="{{ request()->routeIs('tambah-stok-sales') ? 'active' : '' }}">Tambah Stok Sales</a></li>
									<li><a href="{{ route('riwayat-sales') }}" class="{{ request()->routeIs('riwayat-sales') ? 'active' : '' }}">Riwayat Stok Sales</a></li>
									<li><a href="{{ route('return-stok') }}" class="{{ request()->routeIs('return-stok') ? 'active' : '' }}">Return Stok</a></li>
									<li><a href="{{ route('target-sales')}}" class="{{ request()->routeIs('target-sales') ? 'active' : '' }}">Target Sales</a></a></li>
								</ul>
							</li>
							<li>
								<a href="{{ route('daftar-toko') }}" class="{{ request()->routeIs('daftar-toko') ? 'active' : '' }}"><i class="fe fe-shopping-cart"></i> <span> Toko</span></a>
							</li>
							<li class="submenu">
								<a><i class="fe fe-shopping-bag"></i> <span> Transaksi</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('harga') }}" class="{{ request()->routeIs('harga') ? 'active' : '' }}">Harga & Diskon</a></li>
									<li><a href="{{ route('faktur-terima-barang') }}" class="{{ request()->routeIs('faktur-terima-barang') ? 'active' : '' }}">Faktur Terima Barang</a></li>
									<li><a href="{{ route('faktur-pembayaran') }}" class="{{ request()->routeIs('faktur-pembayaran') ? 'active' : '' }}">Faktur Pembayaran</a></li>
								</ul>
							</li>
							<li class="menu-title"><span>Settings</span></li>							
							<li>
								<a href="{{ route('logout') }}"><i class="fe fe-power"></i> <span>Logout</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /Sidebar -->

			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					@yield('content-admin')
					
				</div>			
			</div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->


		<!--Theme Setting -->
		<div class="settings-icon"> 
			<span data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas"><img src="{{asset('assets/img/icons/siderbar-icon2.svg')}}" class="feather-five" alt="layout"></span> 
		</div> 
		<div class="offcanvas offcanvas-end border-0 " tabindex="-1" id="theme-settings-offcanvas"> 
			<div class="sidebar-headerset">
				<div class="sidebar-headersets">
					<h2>Pengaturan Tampilan</h2>
					<h3>Mengatur tampilan halaman</h3>
				</div>
				<div class="sidebar-headerclose">
					<a data-bs-dismiss="offcanvas" aria-label="Close"><img src="{{ asset('assets/img/close.png')}}" alt="img"></a>
				</div>
			</div>
			<div class="offcanvas-body p-0"> 
				<div data-simplebar class="h-100"> 
					<div class="settings-mains"> 
						<div class="layout-head">
							<h5>Tampilan</h5>
							<h6>Mengatur Tampilan</h6>
						</div>
						<div class="row"> 
							<div class="col-4"> 
								<div class="form-check card-radio p-0"> 
									<input id="customizer-layout01" name="data-layout" type="radio" value="vertical" class="form-check-input"> 
									<label class="form-check-label avatar-md w-100" for="customizer-layout01"> 
										<img src="{{ asset('assets/img/vertical.png')}}" alt="img">
									</label> 
								</div> 
								<h5 class="fs-13 text-center mt-2">Menu Atas</h5> 
							</div> 
							<div class="col-4"> 
								<div class="form-check card-radio p-0"> 
								<input id="customizer-layout02" name="data-layout" type="radio" value="horizontal" class="form-check-input"> 
									<label class="form-check-label  avatar-md w-100" for="customizer-layout02"> 
										<img src="{{ asset('assets/img/horizontal.png')}}" alt="img">
									</label> 
								</div> 
								<h5 class="fs-13 text-center mt-2">Menu Samping</h5> 
							</div> 
							<div class="d-flex align-items-center justify-content-between pt-3">
						</div>
					<div class="layout-head pt-3">
								<h5>Tampilan Warna</h5>
								<h6>Pilihan warna gelap dan terang.</h6>
							</div>
							<div class="colorscheme-cardradio"> 
								<div class="row"> 
									<div class="col-4">
										<div class="form-check card-radio blue  p-0 "> 
											<input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-blue" value="blue"> 
											<label class="form-check-label  avatar-md w-100" for="layout-mode-blue"> 
												<img src="{{ asset('assets/img/vertical.png')}}" alt="img">
											</label> 
										</div> 
										<h5 class="fs-13 text-center mt-2 mb-2">Asli</h5> 
									</div>
								<div class="col-4"> 
									<div class="form-check card-radio p-0"> 
										<input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-light" value="light"> 
										<label class="form-check-label  avatar-md w-100" for="layout-mode-light"> 
											<img src="{{ asset('assets/img/vertical.png')}}" alt="img">
										</label> 
									</div> 
									<h5 class="fs-13 text-center mt-2 mb-2">Terang</h5> 
								</div> 
								<div class="col-4"> 
									<div class="form-check card-radio dark  p-0 "> 
										<input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-dark" value="dark"> 
										<label class="form-check-label avatar-md w-100 " for="layout-mode-dark"> 
											<img src="{{ asset('assets/img/vertical.png')}}" alt="img">
										</label> 
									</div> 
									<h5 class="fs-13 text-center mt-2 mb-2">Gelap</h5> 
								</div> 
							</div> 
						</div> 

						<div id="sidebar-color"> 
							<div class="layout-head pt-3">
								<h5>Warna Menu</h5>
								<h6>Pilih Warna Menu</h6>
							</div>
							<div class="row"> 
								<div class="col-4"> 
									<div class="form-check sidebar-setting card-radio p-0" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient.show"> 
										<input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-light" value="light"> 
										<label class="form-check-label  avatar-md w-100" for="sidebar-color-light"> 
											<span class="bg-light bg-sidebarcolor"></span>
										</label> 
									</div> 
									<h5 class="fs-13 text-center mt-2">Terang</h5> 
								</div> 
								<div class="col-4"> 
									<div class="form-check sidebar-setting card-radio p-0" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient.show"> 
										<input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-dark" value="dark"> 
										<label class="form-check-label  avatar-md w-100" for="sidebar-color-dark"> 
											<span class="bg-darks bg-sidebarcolor"></span>
										</label> 
									</div> 
									<h5 class="fs-13 text-center mt-2">Gelap</h5> 
								</div> 

							</div>
							
						</div> 
					</div> 
				</div> 

			</div> 
		</div>
		<!-- /Theme Setting -->	
				
		 <!-- Link to jQuery and Bootstrap JS -->
         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

		<!-- Datatable JS -->
		<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/js/dataTables.bootstrap5.min.js')}}"></script>

		<!-- select CSS -->
		<script src="{{asset('assets/js/select2.min.js')}}"></script>

        <!-- Select 2 -->
		<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
		<script src="{{asset('assets/plugins/select2/js/custom-select.js')}}"></script>
		
		<!-- Feather Icon JS -->
		<script src="{{asset('assets/js/feather.min.js')}}"></script>
		
		<!-- Slimscroll JS -->
		<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

		<!-- multiselect JS -->
		<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>

		<!-- Theme Settings JS -->
		<script src="{{asset('assets/js/theme-settings.js')}}"></script>
		<script src="{{asset('assets/js/greedynav.js')}}"></script>

		<!-- Fileupload JS -->
		<script src="{{asset('assets/js/file-upload.js')}}"></script>

		<!-- Datepicker Core JS -->
		<script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
		<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>

		<!-- Moment JS -->
		<script src="{{asset('assets/js/moment.min.js')}}"></script>
		
		<!-- multiselect JS -->
		<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js')}}"></script>

	</body>
</html>