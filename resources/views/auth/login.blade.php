@extends('layouts.master-without-nav')

@section('title')
    Đăng Nhập
@endsection

@section('body')
<body class="bg-light">
@endsection

@section('content')
    <div class="auth-page d-flex align-items-center min-vh-100" style="background-image: url('build/images/logo-01.png'); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9">
                    <div class="card shadow-lg" style="border: 2px solid #4fc3f7;"> <!-- Thêm viền màu xanh -->
                        <div class="card-header text-center bg-info text-white">
                        <h4 class="mb-1 text-white">Đăng Nhập</h4>
                            <p class="welcome-message mb-0">Xin mời đăng nhập để sử dụng hệ thống!</p>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <a href="index" class="d-inline-block auth-logo">
                                    <img src="build/images/logo-01.png" alt="" class="mb-2" height="100">
                                    <h1 class="logo-txt">Tuan Anh</h1> <!-- Chữ "Tuan Anh" nhỏ -->
                                </a>
                            </div>
                            <form method="POST" action="{{ route('login.submit') }}" class="custom-form">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label">Email</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email" placeholder="Nhập email của bạn"
                                        value="{{ old('email', 'admin@teamexp.net') }}" required autocomplete="email"
                                        autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Mật khẩu</label>
                                    <div class="input-group">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            name="password" placeholder="Nhập mật khẩu"
                                            required autocomplete="current-password">
                                        <button class="btn btn-outline-secondary" type="button" id="password-addon">
                                            <i class="mdi mdi-eye-outline"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <button type="submit" class="btn btn-info w-100 text-white">Đăng Nhập</button>
                                </div>
                            </form>
                            <div class="text-center">
                              <!-- Có thể thêm một câu hoặc thông tin khác ở đây nếu cần -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Toggle Password Visibility
        document.getElementById('password-addon').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('mdi-eye-outline');
            this.querySelector('i').classList.toggle('mdi-eye-off-outline');
        });
    </script>
@endsection
