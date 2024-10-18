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
        align-items: flex-start;
        /* Để đảm bảo ảnh và thông tin không chèn lên nhau */
        min-height: 100vh;
        padding: 10px;
        background-color: #f8f9fa;
    }

    .product-detail-card {
        width: 70%;
        /* Tăng kích thước form để chiếm nhiều chiều ngang hơn */
        max-width: 1200px;
        padding: 10px;
        border-radius: 15px;
        background-color: #ffffff;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .product-detail img {
        max-width: 50%;
        /* Giảm kích thước ảnh nếu quá to */
        max-height: 400px;
        /* Giới hạn chiều cao của ảnh */
        height: auto;
        border-radius: 10px;
        /* margin: px auto; */
        display: block; /* Đảm bảo hình ảnh là một block để margin hoạt động */
        margin-bottom: 20px; /* Tăng khoảng cách giữa hình ảnh và chữ bên dưới */

    }

    .product-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* Sắp xếp thông tin thành 2 cột */
        column-gap: 60px;
        /* Khoảng cách giữa các cột */
        row-gap: 15px;
        /* Khoảng cách giữa các hàng */
        font-size: 18px;
        color: #495057;
        margin-bottom: 0px;
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

    /* Đảm bảo layout ảnh và thông tin không chèn lên nhau */
    .card-body {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
    }

    /* Điều chỉnh thông tin và hình ảnh để phù hợp với kích thước màn hình */
    @media (max-width: 768px) {
        .product-detail img {
            max-width: 80%;
            display: block; /* Đảm bảo hình ảnh là một block để margin hoạt động */
            margin-bottom: 20px; /* Tăng khoảng cách giữa hình ảnh và chữ bên dưới */
            /* Ảnh nhỏ hơn trên màn hình nhỏ */
        }

        .product-info {
            grid-template-columns: 1fr;
            /* Thay đổi thành 1 cột trên màn hình nhỏ */
        }
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
            {{-- Hiển thị hình ảnh sản phẩm --}}
            @if ($sanPham->hinh_anh)
            <img src="{{ asset($sanPham->hinh_anh) }}" alt="{{ $sanPham->ten_san_pham }}">
            @else
            <p>Không có hình ảnh</p>
            @endif

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