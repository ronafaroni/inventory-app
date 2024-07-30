<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light"  data-sidebar-size="lg" data-sidebar-image="none"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Distribusi Barang Bunga Coklat">
    <meta name="keywords" content="Sistem Informasi, Distribusi Barang, Bunga Coklat">
    <title>Bunga Coklat | Sistem Informasi Distribusi Barang</title>
    <link rel="shortcut icon" href="assets/img/favicon bunga coklat.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/layout.js"></script>
</head>
<body>

<div class="main-wrapper">
    <div class="row m-0 align-items-center bg-white vh-100">
        <div class="col-lg">
            <div class="saas-login-wrapper p-0">
                <div class="login-content">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="login-userset">
                            <div class="login-logo">
                                <img src="assets/img/logo bunga coklat.png" alt="img">
                            </div>
                            <div class="login-card">
                                <div class="login-heading">
                                    <h3>Login Admin</h3>
                                </div>
                                <div class="input-block mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Username Anda" autocomplete="off" value="{{ old('username') }}">
                                    @error('username')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="input-block mb-3">
                                    <label class="form-control-label">Password</label>
                                    <div class="pass-group">
                                        <input type="password" name="password" id="password" class="form-control pass-input" placeholder="Masukkan Password Anda" autocomplete="off" value="{{ old('password') }}">
                                        <span class="fas fa-eye-slash toggle-password"></span>
                                        @error('password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-block mb-0">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-check custom-checkbox mb-3">
                                                <input type="checkbox" class="form-check-input" id="cb1" name="remember">
                                                <label class="custom-control-label mb-0" for="cb1">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-sm-end mb-3">
                                            <a class="forgot-link" href="#">Forgot Your Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>      
        </div>
    </div>
</div>

<script src="assets/js/jquery-3.7.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/theme-settings.js"></script>
<script src="assets/js/greedynav.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>
