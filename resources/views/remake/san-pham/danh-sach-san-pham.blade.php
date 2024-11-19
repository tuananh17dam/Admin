@extends('layouts.master')

@section('title')
Danh mục sản phẩm
@endsection

@section('css')
<link href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/datatables.net-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    /* CSS cho bảng */
    .table {
        width: 100%;
    }

    .table thead th {
        background-color: #f8f9fa;
        color: #495057;
        text-align: center;
        vertical-align: middle;
    }

    .table tbody td {
        text-align: center;
        vertical-align: middle;
    }

    .table img {
        max-width: 80px;
        height: auto;
        border-radius: 5px;
    }

    .action-buttons .btn {
        margin-right: 5px;
    }

    /* Thẻ sản phẩm cho thiết bị di động */
    .product-card {
        display: none;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 8px;
        background-color: #f8f9fa;
    }

    .product-card img {
        max-width: 100px;
        height: auto;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .product-card .product-info {
        margin-left: 10px;
    }

    .product-card .product-info h5 {
        margin: 0;
        font-size: 1rem;
    }

    .product-card .product-info p {
        margin: 2px 0;
    }

    .product-card .action-buttons .btn {
        padding: 5px 10px;
    }

    @media (max-width: 768px) {
        .table-responsive {
            display: none;
        }

        .product-card {
            display: flex;
            align-items: flex-start;
        }
    }
</style>
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Sản phẩm @endslot
@slot('title') Danh sách sản phẩm @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="row mb-4">
                    <div class="col-sm">
                        <a href="{{ route('san-pham.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus me-1"></i> Thêm sản phẩm
                        </a>
                    </div>
                </div>

                <!-- Bảng sản phẩm cho desktop -->
                <div class="table-responsive">
                    <table class="table align-middle datatable dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá nhập</th>
                                <th>Giá bán</th>
                                <th>Hình ảnh</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sanPhams as $sanPham)
                            <tr>
                                <td>{{ $sanPham->id }}</td>
                                <td>{{ $sanPham->ten_san_pham }}</td>
                                <td>{{ number_format($sanPham->gia_nhap) }} VND</td>
                                <td>{{ number_format($sanPham->gia_ban) }} VND</td>
                                <td>
                                    <img src="{{ asset($sanPham->hinh_anh) }}" alt="{{ $sanPham->ten_san_pham }}">
                                </td>
                                <td class="action-buttons">
                                    <a href="{{ route('san-pham.show', $sanPham->id) }}" class="btn btn-info btn-sm">Chi tiết</a>
                                    <a href="{{ route('san-pham.edit', $sanPham->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                                    <form action="{{ route('san-pham.destroy', $sanPham->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Thẻ sản phẩm cho thiết bị di động -->
                <div class="product-cards">
                    @foreach ($sanPhams as $sanPham)
                    <div class="product-card">
                        <img src="{{ asset($sanPham->hinh_anh) }}" alt="{{ $sanPham->ten_san_pham }}" class="product-image">
                        <div class="product-info">
                            <h5>{{ $sanPham->ten_san_pham }}</h5>
                            <p>ID: {{ $sanPham->id }}</p>
                            <p>Giá nhập: {{ number_format($sanPham->gia_nhap) }} VND</p>
                            <p>Giá bán: {{ number_format($sanPham->gia_ban) }} VND</p>
                            <div class="action-buttons d-flex">
                                <a href="{{ route('san-pham.show', $sanPham->id) }}" class="btn btn-info btn-sm flex-fill text-center">Xem</a>
                                <a href="{{ route('san-pham.edit', $sanPham->id) }}" class="btn btn-primary btn-sm flex-fill text-center">Sửa</a>
                                <form action="{{ route('san-pham.destroy', $sanPham->id) }}" method="POST" class="flex-fill text-center" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?')">Xóa</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
@endsection