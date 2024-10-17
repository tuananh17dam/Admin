@extends('layouts.master')

@section('title')
Chi tiết sản phẩm
@endsection

@section('css')
<link href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<style>
    /* CSS căn giữa và mở rộng form */
    .product-detail-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        padding: 20px;
        background-color: #f8f9fa;
    }

    .product-detail-card {
        width: 80%; /* Tăng kích thước form để chiếm nhiều chiều ngang hơn */
        max-width: 1200px;
        padding: 20px; /* Giảm padding để giảm chiều cao */
        border-radius: 15px;
        background-color: #ffffff;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .product-detail img {
        max-width: 60%; /* Giảm kích thước ảnh */
        height: auto;
        border-radius: 10px;
        margin: 20px auto;
        display: block;
    }

    .product-info {
        display: grid;
        grid-template-columns: 1fr 1fr; /* Sắp xếp thông tin thành 2 cột */
        gap: 15px;
        font-size: 18px;
        color: #495057;
        margin-bottom: 15px;
    }

    .product-info h5 {
        font-weight: bold;
        color: #343a40;
    }

    .product-info p {
        margin-bottom: 0;
        color: #6c757d;
    }

    .btn-back {
        display: inline-block;
        margin-top: 20px;
        background-color: #6c757d;
        color: white;
        border-radius: 10px;
        padding: 10px 20px;
        text-align: center;
    }

    .btn-back:hover {
        background-color: #5a6268;
    }

    /* Căn chỉnh nút về dưới nhưng vẫn trong tầm nhìn */
    .card-body {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        height: 100%;
    }

</style>
@endsection

@section('content')
@component('components.breadcrumb')
    @slot('li_1') Sản phẩm @endslot
    @slot('title') Chi tiết sản phẩm @endslot
@endcomponent

<div class="product-detail-container">
    <div class="card product-detail-card">
        <div class="card-body product-detail text-center">
            {{-- <img src="asset{{ ($sanPham->hinh_anh) }}"
            $path = {{$sanPham->hinh_anh}};
             dd($path);
            
                 alt="{{ $sanPham->ten_san_pham }}"> --}}

            <div class="product-info">
                <div>
                    <h5>Mã sản phẩm:</h5>
                    <p>{{ $sanPham->id }}</p>
                </div>
                <div>
                    <h5>Tên sản phẩm:</h5>
                    <p>{{ $sanPham->ten_san_pham }}</p>
                </div>
                <div>
                    <h5>Giá nhập:</h5>
                    <p>{{ $sanPham->gia_nhap }} VND</p>
                </div>
                <div>
                    <h5>Giá bán:</h5>
                    <p>{{ $sanPham->gia_ban }} VND</p>
                </div>
            </div>

            <a href="{{ route('san-pham.index') }}" class="btn btn-secondary btn-back">
                <i class="bx bx-arrow-back"></i> Trở về
            </a>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
@endsection
