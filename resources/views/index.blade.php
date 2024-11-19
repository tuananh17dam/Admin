@extends('layouts.master')

@section('title') Trang chủ @endsection



@section('content')
<div class="container my-0">
    <!-- Logo của hệ thống -->
    <div class="logo text-center mb-3">
        <img src="{{ asset('build/images/logo-01.png') }}" alt="Logo hệ thống" class="img-fluid" style="max-width: 150px;">
    </div>

    <h1 class="text-center mb-4 text-primary" style="font-weight: bold; font-size: 2.0rem;">TRANG CHỦ</h1>

    <div class="row g-3 justify-content-center">
        <!-- Card cho từng chức năng -->
        @if(auth()->user()->role === 'admin')
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card text-center p-3 shadow-sm border-primary border-2">
                <a href="{{ url('/don-hang') }}" class="text-decoration-none text-dark">
                    <i data-feather="shopping-cart" class="display-6 text-primary"></i>
                    <h5 class="mt-2">Đơn hàng</h5>
                    <p class="text-muted small">Quản lý đơn hàng</p>
                </a>
            </div>
        </div>
        @endif

        @if(auth()->user()->role === 'seller')
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card text-center p-3 shadow-sm border-success border-2">
                <a href="{{ url('donhang-seller') }}" class="text-decoration-none text-dark">
                    <i data-feather="shopping-cart" class="display-6 text-success"></i>
                    <h5 class="mt-2">Đơn hàng</h5>
                    <p class="text-muted small">Quản lý đơn hàng</p>
                </a>
            </div>
        </div>
        @endif

        <div class="col-6 col-md-4 col-lg-3">
            <div class="card text-center p-3 shadow-sm border-info border-2">
                <a href="{{ url('/san-pham') }}" class="text-decoration-none text-dark">
                    <i data-feather="box" class="display-6 text-info"></i>
                    <h5 class="mt-2">Sản phẩm</h5>
                    <p class="text-muted small">Quản lý sản phẩm</p>
                </a>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <div class="card text-center p-3 shadow-sm border-secondary border-2">
                <a href="{{ url('/khach-hang') }}" class="text-decoration-none text-dark">
                    <i data-feather="users" class="display-6 text-secondary"></i>
                    <h5 class="mt-2">Khách hàng</h5>
                    <p class="text-muted small">Thông tin khách hàng</p>
                </a>
            </div>
        </div>

        @if(auth()->user()->role === 'admin')
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card text-center p-3 shadow-sm border-danger border-2">
                <a href="{{ url('/user') }}" class="text-decoration-none text-dark">
                    <i data-feather="user-check" class="display-6 text-danger"></i>
                    <h5 class="mt-2">Tài khoản bán hàng</h5>
                    <p class="text-muted small">Quản lý tài khoản</p>
                </a>
            </div>
        </div>
        @endif

        <div class="col-6 col-md-4 col-lg-3">
            <div class="card text-center p-3 shadow-sm border-primary border-2">
                <a href="{{ url('/thong-ke') }}" class="text-decoration-none text-dark">
                    <i data-feather="bar-chart-2" class="display-6 text-primary"></i>
                    <h5 class="mt-2">Thống kê</h5>
                    <p class="text-muted small">Báo cáo và thống kê</p>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace()
</script>
<style>
    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }

    .card h5 {
        font-weight: bold;
        font-size: 1rem;
    }
</style>
@endsection