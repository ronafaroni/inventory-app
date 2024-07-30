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
								<a href="{{'/dashboard'}}"><i class="fe fe-home"></i> <span> Dashboard</span></a>
							</li>
							<li class="submenu">
								<a><i class="fe fe-package"></i> <span> Stok Barang</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="#">Tambah Item</a></li>
									<li><a href="#">Stok Tersedia</a></li>
									<li><a href="#">Tambah Stok</a></li>
									<li><a href="#">Riwayat Tambah Stok</a></li>
									<li><a href="#">Tambah Stok Sales</a></li>
									<li><a href="#">Riwayat Tambah Stok Sales</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a><i class="fe fe-users"></i> <span> Sales</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a href="#">Daftar Sales</a></li>
									<li><a href="#">Return Stok</a></li>
								</ul>
							</li>
							<li>
								<a><i class="fe fe-shopping-cart"></i> <span> Toko</span></a>
							</li>
							<li class="submenu">
								<a><i class="fe fe-shopping-bag"></i> <span> Transaksi</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="#">Harga / Diskon</a></li>
									<li><a href="#">Faktur Terima BArang</a></li>
									<li><a href="#">Faktur Pembayaran</a></li>
								</ul>
							</li>

							<!-- Settings -->
							<li class="menu-title"><span>Settings</span></li>							
							<li>
								<a href="login.html"><i class="fe fe-power"></i> <span>Logout</span></a>
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
							<h2>Customizer</h2>
							<h3>Customize your overview Page layout</h3>
						</div>
						<div class="sidebar-headerclose">
							<a data-bs-dismiss="offcanvas" aria-label="Close"><img src="{{ asset('assets/img/close.png')}}" alt="img"></a>
						</div>
					</div>
					<div class="offcanvas-body p-0"> 
						<div data-simplebar class="h-100"> 
							<div class="settings-mains"> 
								<div class="layout-head">
									<h5>Layout</h5>
									<h6>Choose your layout</h6>
								</div>
								<div class="row"> 
									<div class="col-4"> 
										<div class="form-check card-radio p-0"> 
											<input id="customizer-layout01" name="data-layout" type="radio" value="vertical" class="form-check-input"> 
											<label class="form-check-label avatar-md w-100" for="customizer-layout01"> 
												<img src="{{ asset('assets/img/vertical.png')}}" alt="img">
											</label> 
										</div> 
										<h5 class="fs-13 text-center mt-2">Vertical</h5> 
									</div> 
									<div class="col-4"> 
										<div class="form-check card-radio p-0"> 
										<input id="customizer-layout02" name="data-layout" type="radio" value="horizontal" class="form-check-input"> 
											<label class="form-check-label  avatar-md w-100" for="customizer-layout02"> 
												<img src="{{ asset('assets/img/horizontal.png')}}" alt="img">
											</label> 
										</div> 
										<h5 class="fs-13 text-center mt-2">Horizontal</h5> 
									</div> 
									<div class="col-4 d-none"> 
										<div class="form-check card-radio p-0"> 
											<input id="customizer-layout03" name="data-layout" type="radio" value="twocolumn" class="form-check-input"> 
											<label class="form-check-label  avatar-md w-100" for="customizer-layout03"> 
												<img src="{{ asset('assets/img/two-column.png')}}" alt="img">
											</label> 
										</div> 
										<h5 class="fs-13 text-center mt-2">Two Column</h5> 
										</div> 
									</div> 
									<div class="d-flex align-items-center justify-content-between pt-3">
								<div class="layout-head mb-0">
									<h5>RTL Mode</h5>
									<h6>Change Language Direction.</h6>
								</div>
								<div class="active-switch">
									<div class="status-toggle">
										<input id="rtl" class="check" type="checkbox">
										<label for="rtl" class="checktoggle checkbox-bg">checkbox</label>
									</div>
								</div>
							</div><div class="layout-head pt-3">
										<h5>Color Scheme</h5>
										<h6>Choose Light or Dark Scheme.</h6>
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
												<h5 class="fs-13 text-center mt-2 mb-2">Blue</h5> 
											</div>
										<div class="col-4"> 
											<div class="form-check card-radio p-0"> 
												<input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-light" value="light"> 
												<label class="form-check-label  avatar-md w-100" for="layout-mode-light"> 
													<img src="{{ asset('assets/img/vertical.png')}}" alt="img">
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2 mb-2">Light</h5> 
										</div> 
										<div class="col-4"> 
											<div class="form-check card-radio dark  p-0 "> 
												<input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-dark" value="dark"> 
												<label class="form-check-label avatar-md w-100 " for="layout-mode-dark"> 
													<img src="{{ asset('assets/img/vertical.png')}}" alt="img">
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2 mb-2">Dark</h5> 
										</div> 
										<div class="col-4 d-none"> 
											<div class="form-check card-radio p-0"> 
												<input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-orange" value="orange"> 
												<label class="form-check-label  avatar-md w-100 " for="layout-mode-orange"> 
													<img src="{{ asset('assets/img/vertical.png')}}" alt="img">
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2 mb-2">Orange</h5> 
										</div> 
										<div class="col-4 d-none"> 
											<div class="form-check card-radio maroon p-0"> 
												<input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-maroon" value="maroon"> 
												<label class="form-check-label  avatar-md w-100 " for="layout-mode-maroon"> 
													<img src="{{ asset('assets/img/vertical.png')}}" alt="img">
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2 mb-2">Brink Pink</h5> 
										</div> 
										<div class="col-4 d-none"> 
											<div class="form-check card-radio purple p-0"> 
												<input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-purple" value="purple"> 
												<label class="form-check-label  avatar-md w-100 " for="layout-mode-purple"> 
													<img src="{{ asset('assets/img/vertical.png')}}" alt="img">
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2 mb-2">Green</h5> 
										</div> 
									</div> 
								</div> 
		
								<div id="layout-width"> 
									<div class="layout-head pt-3">
										<h5>Layout Width</h5>
										<h6>Choose Fluid or Boxed layout.</h6>
									</div>
									<div class="row"> 
										<div class="col-4"> 
											<div class="form-check card-radio p-0"> 
												<input class="form-check-input" type="radio" name="data-layout-width" id="layout-width-fluid" value="fluid"> 
												<label class="form-check-label avatar-md w-100" for="layout-width-fluid"> 
													<img src="{{ asset('assets/img/boxed.png')}}" alt="img">
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2">Fluid</h5> 
										</div> 
										<div class="col-4"> 
											<div class="form-check card-radio p-0 "> 
												<input class="form-check-input" type="radio" name="data-layout-width" id="layout-width-boxed" value="boxed"> 
												<label class="form-check-label avatar-md w-100 px-2" for="layout-width-boxed"> 
													<img src="{{ asset('assets/img/boxed.png')}}" alt="img"> 
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2">Boxed</h5> 
										</div> 
									</div> 
								</div> 
		
								<div id="layout-position" class="d-none"> 
									<div class="layout-head pt-3">
										<h5>Layout Position</h5>
										<h6>Choose Fixed or Scrollable Layout Position.</h6>
									</div>
									<div class="btn-group bor-rad-50 overflow-hidden radio" role="group"> 
										<input type="radio" class="btn-check" name="data-layout-position" id="layout-position-fixed" value="fixed"> 
										<label class="btn btn-light w-sm" for="layout-position-fixed">Fixed</label> 
		
										<input type="radio" class="btn-check" name="data-layout-position" id="layout-position-scrollable" value="scrollable"> 
										<label class="btn btn-light w-sm ms-0" for="layout-position-scrollable">Scrollable</label> 
									</div> 
								</div> 
								<div class="layout-head pt-3">
									<h5>Topbar Color</h5>
									<h6>Choose Light or Dark Topbar Color.</h6>
								</div>
								<div class="row"> 
									<div class="col-4"> 
										<div class="form-check card-radio  p-0"> 
											<input class="form-check-input" type="radio" name="data-topbar" id="topbar-color-light" value="light"> 
											<label class="form-check-label avatar-md w-100" for="topbar-color-light"> 
												<img src="{{ asset('assets/img/light.png')}}" alt="img">
											</label> 
										</div> 
										<h5 class="fs-13 text-center mt-2">Light</h5> 
									</div> 
									<div class="col-4"> 
										<div class="form-check card-radio p-0"> 
											<input class="form-check-input" type="radio" name="data-topbar" id="topbar-color-dark" value="dark"> 
											<label class="form-check-label  avatar-md w-100" for="topbar-color-dark"> 
												<img src="{{ asset('assets/img/dark.png')}}" alt="img">
											</label> 
										</div> 
										<h5 class="fs-13 text-center mt-2">Dark</h5> 
									</div> 
								</div> 
		
								<div id="sidebar-size"> 
									<div class="layout-head pt-3">
										<h5>Sidebar Size</h5>
										<h6>Choose a size of Sidebar.</h6>
									</div>
									<div class="row"> 
										<div class="col-4"> 
											<div class="form-check sidebar-setting card-radio  p-0 "> 
												<input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-default" value="lg" > 
												<label class="form-check-label avatar-md w-100" for="sidebar-size-default"> 
													<img src="{{ asset('assets/img/compact.png')}}" alt="img">
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2">Default</h5> 
										</div> 
		
										<div class="col-4 d-none"> 
											<div class="form-check sidebar-setting card-radio p-0"> 
												<input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-compact" value="md"> 
												<label class="form-check-label  avatar-md w-100" for="sidebar-size-compact"> 
													<img src="{{ asset('assets/img/compact.png')}}" alt="img">
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2">Compact</h5> 
										</div> 
		
										<div class="col-4"> 
											<div class="form-check sidebar-setting card-radio p-0 "> 
												<input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-small-hover" value="sm-hover" > 
												<label class="form-check-label avatar-md w-100" for="sidebar-size-small-hover"> 
													<img src="{{ asset('assets/img/compact.png')}}" alt="img">
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2">Small Sidebar</h5> 
										</div> 
									</div> 
								</div> 
		
								<div id="sidebar-view"> 
									<div class="layout-head pt-3">
										<h5>Sidebar View</h5>
										<h6>Choose Default or Detached Sidebar view.</h6>
									</div>
									<div class="row"> 
										<div class="col-4"> 
											<div class="form-check sidebar-setting card-radio  p-0"> 
												<input class="form-check-input" type="radio" name="data-layout-style" id="sidebar-view-default" value="default"> 
												<label class="form-check-label avatar-md w-100" for="sidebar-view-default"> 
													<img src="{{ asset('assets/img/default.png')}}" alt="img">
												</label>
												</div> 
											<h5 class="fs-13 text-center mt-2">Default</h5> 
										</div> 
										<div class="col-4"> 
											<div class="form-check sidebar-setting card-radio p-0"> 
												<input class="form-check-input" type="radio" name="data-layout-style" id="sidebar-view-detached" value="detached"> 
												<label class="form-check-label  avatar-md w-100" for="sidebar-view-detached"> 
													<img src="{{ asset('assets/img/detached.png')}}" alt="img">
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2">Detached</h5> 
										</div> 
									</div> 
								</div> 
								<div id="sidebar-color"> 
									<div class="layout-head pt-3">
										<h5>Sidebar Color</h5>
										<h6>Choose a color of Sidebar.</h6>
									</div>
									<div class="row"> 
										<div class="col-4"> 
											<div class="form-check sidebar-setting card-radio p-0" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient.show"> 
												<input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-light" value="light"> 
												<label class="form-check-label  avatar-md w-100" for="sidebar-color-light"> 
													<span class="bg-light bg-sidebarcolor"></span>
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2">Light</h5> 
										</div> 
										<div class="col-4"> 
											<div class="form-check sidebar-setting card-radio p-0" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient.show"> 
												<input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-dark" value="dark"> 
												<label class="form-check-label  avatar-md w-100" for="sidebar-color-dark"> 
													<span class="bg-darks bg-sidebarcolor"></span>
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2">Dark</h5> 
										</div> 
										<div class="col-4 d-none"> 
											<div class="form-check sidebar-setting card-radio p-0"> 
												<input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-gradient" value="gradient"> 
												<label class="form-check-label avatar-md w-100" for="sidebar-color-gradient"> 
													<span class="bg-gradients bg-sidebarcolor"></span>
												</label>  
											</div> 
											<h5 class="fs-13 text-center mt-2">Gradient</h5> 
										</div>
										<div class="col-4 d-none"> 
											<button class="btn btn-link avatar-md w-100 p-0 overflow-hidden border collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient" aria-expanded="false"> 
												<span class="d-flex gap-1 h-100"> 
													<span class="flex-shrink-0"> 
														<span class="bg-vertical-gradient d-flex h-100 flex-column gap-1 p-1"> 
															<span class="d-block p-1 px-2 bg-soft-light rounded mb-2"></span> 
															<span class="d-block p-1 px-2 pb-0 bg-soft-light"></span> 
															<span class="d-block p-1 px-2 pb-0 bg-soft-light"></span> 
															<span class="d-block p-1 px-2 pb-0 bg-soft-light"></span> 
															</span> 
														</span> 
														<span class="flex-grow-1"> 
															<span class="d-flex h-100 flex-column"> 
																<span class="bg-light d-block p-1"></span> 
																<span class="bg-light d-block p-1 mt-auto"></span> 
															</span> 
														</span> 
													</span> 
												</button> 
												<h5 class="fs-13 text-center mt-2">Gradient</h5> 
										</div> 
									</div>
									
								</div> 
							</div> 
						</div> 
		
					</div> 
					<div class="offcanvas-footer border-top p-3 text-center"> 
						<div class="row"> 
							<div class="col-6"> 
								<button type="button" class="btn btn-light w-100 bor-rad-50" id="reset-layout">Reset</button> 
							</div> 
							<div class="col-6"> 
								<a href="https://themeforest.net/item/smarthr-bootstrap-admin-panel-template/21153150" target="_blank" class="btn btn-primary w-100 bor-rad-50">Buy Now</a> 
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