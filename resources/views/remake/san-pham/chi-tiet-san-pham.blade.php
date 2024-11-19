@extends('layouts.master')

@section('title')
Chi tiết sản phẩm
@endsection

@section('css')
<link href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<style>
    .product-detail-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: auto;
        /* Loại bỏ min-height để tránh chiều cao dư thừa */
        padding: 0 20px;
        /* Đặt lại padding để không có khoảng cách thừa phía trên */
        background-color: #ffffff;
        margin-top: 0;
        /* Đảm bảo không có khoảng cách bên trên */
    }

    .product-table {
        width: 80%;
        max-width: 1000px;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
    }

    .product-table td {
        padding: 20px;
        vertical-align: top;
    }

    .product-table .image-cell {
        width: 50%;
        text-align: center;
        background-color: #f1f3f5;
    }

    .product-table .image-cell img {
        max-width: 100%;
        max-height: 400px;
        border-radius: 10px;
    }

    .product-table .info-cell {
        width: 50%;
    }

    .product-info {
        font-size: 18px;
        color: #495057;
    }

    .product-info h5 {
        font-weight: bold;
        color: #343a40;
        margin-bottom: 10px;
    }

    .product-info p {
        color: #6c757d;
        margin-bottom: 15px;
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

    @media (max-width: 768px) {
        .product-table {
            width: 90%;
        }

        .product-table td {
            display: block;
            width: 100%;
        }

        .product-table .image-cell,
        .product-table .info-cell {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Sản phẩm @endslot
@slot('title') Chi tiết sản phẩm @endslot
@endcomponent

<div class="product-detail-container" style="background-color: #99FFFF;">
    <table class="product-table">
        <tr>
            {{-- Ô bên trái hiển thị hình ảnh sản phẩm --}}
            <td class="image-cell">
                @if ($sanPham->hinh_anh)
                <img src="{{ asset($sanPham->hinh_anh) }}" alt="{{ $sanPham->ten_san_pham }}">
                @else
                <p>Không có hình ảnh</p>
                @endif
            </td>

            {{-- Ô bên phải hiển thị thông tin sản phẩm --}}
            <td class="info-cell">
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

                <a href="{{ route('san-pham.index') }}" class="btn btn-secondary btn-back" style="float: right; margin-top: 20px;">
                    <i class="bx bx-arrow-back"></i> Trở về
                </a>

            </td>
        </tr>
    </table>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
@endsection