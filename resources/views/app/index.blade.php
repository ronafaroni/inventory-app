<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Materil | Angular Material Design Admin Template</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="{{asset('assets-app/libs/assets/animate.css/animate.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('assets-app/libs/assets/font-awesome/css/font-awesome.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('assets-app/libs/jquery/waves/dist/waves.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('assets-app/styles/material-design-icons.css')}}" type="text/css" />

  <link rel="stylesheet" href="{{asset('assets-app/libs/jquery/bootstrap/dist/css/bootstrap.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('assets-app/libs/jquery/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('assets-app/styles/font.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('assets-app/styles/app.css')}}" type="text/css" />

  <style>
    .bottom-nav {
      position: fixed;
      bottom: 0;
      width: 100%;
      background-color: #fff;
      box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
      z-index: 1000;
    }
  
    .bottom-nav ul {
      display: flex;
      justify-content: space-around;
      margin: 0;
      padding: 10px 0;
      list-style: none;
    }
  
    .bottom-nav ul li a {
      text-align: center;
      display: block;
      color: #333;
      text-decoration: none;
      transition: background-color 0.3s, color 0.3s;
    }
  
    .bottom-nav ul li a:hover, .bottom-nav ul li.active a {
      background-color: #f0f0f0; /* Warna background saat hover atau aktif */
      color: #007bff; /* Warna teks saat hover atau aktif */
    }
  
    .bottom-nav ul li a i {
      display: block;
      font-size: 24px;
      margin-bottom: 5px;
    }
  </style>
  
  
</head>
<body>
<div class="app">
  
  <!-- content -->
  <div id="content" class="app-content" role="main" style="padding-bottom: 50px;">
    <div class="box">
          <!-- Content Navbar -->
    <div class="navbar md-whiteframe-z1 no-radius blue">
      <!-- Open side - Navigation on mobile -->
      <a md-ink-ripple data-toggle="modal" data-target="#aside" class="navbar-item pull-left visible-xs visible-sm">
        {{-- <i class="mdi-navigation-menu i-24"></i> --}}
  
      </a>
      <!-- / -->
      <!-- Page title - Bind to $state's title -->
      <div class="navbar-item pull-left h4">
        {{ $title }}
      </div>

      <ul class="nav nav-sm navbar-tool pull-right">

        <li>
          <a href="{{ route('app-logout') }}">
            <i class="mdi-action-exit-to-app i-24"></i>
          </a>
        </li>

      </ul>
      <!-- / -->
    </div>
    <!-- Content -->

      <div class="box-row">
        <div class="box-cell">
          <div class="box-inner padding">
            
            @yield('content-app')
            <br>
            <br>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- / content -->

  <!-- Bottom Navigation -->
  <div class="bottom-nav">
    <ul class="nav">
      <li>
        <a md-ink-ripple href="{{ route('app-toko-sales') }}">
          <i class="icon mdi-action-store i-20"></i>
          <span class="font-normal">Toko</span>
        </a>
      </li>
      <li>
        <a md-ink-ripple href="{{ route('app-daftar-kunjungan')}}">
          <i class="icon mdi-device-now-wallpaper i-20"></i>
          <span class="font-normal">Kunjungan</span>
        </a>
      </li>
      <li>
        <a md-ink-ripple href="{{ route('app-profile')}}">
          <i class="icon mdi-action-account-circle i-20"></i>
          <span class="font-normal">Profile</span>
        </a>
      </li>
    </ul>
  </div>
  <!-- / Bottom Navigation -->

</div>

<script src="{{ asset('assets-app/libs/jquery/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('assets-app/libs/jquery/bootstrap/dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets-app/libs/jquery/waves/dist/waves.js') }}"></script>

<script src="{{ asset('assets-app/scripts/ui-load.js') }}"></script>
<script src="{{ asset('assets-app/scripts/ui-jp.config.js') }}"></script>
<script src="{{ asset('assets-app/scripts/ui-jp.js') }}"></script>
<script src="{{ asset('assets-app/scripts/ui-nav.js') }}"></script>
<script src="{{ asset('assets-app/scripts/ui-toggle.js') }}"></script>
<script src="{{ asset('assets-app/scripts/ui-form.js') }}"></script>
<script src="{{ asset('assets-app/scripts/ui-waves.js') }}"></script>
<script src="{{ asset('assets-app/scripts/ui-client.js') }}"></script>

</body>
</html>
