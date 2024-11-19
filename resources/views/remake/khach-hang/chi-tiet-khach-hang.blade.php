@extends('layouts.master')

@section('css')
<link href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<style>
    /* Tạo bảng chi tiết khách hàng với màu sắc tươi sáng */
    .customer-detail-container {
        display: flex;
        justify-content: center;
        padding: 20px;
    }

    .customer-detail-card {
        width: 100%;
        max-width: 800px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #e7f1ff; /* Nền xanh dương nhạt */
    }

    .customer-info th {
        background-color: #d0e2ff;
        color: #495057;
        font-weight: bold;
        text-align: left;
        padding: 10px;
    }

    .customer-info td {
        padding: 10px;
        text-align: left;
    }

    .btn-back {
        display: block;
        margin-top: 15px;
        text-align: center;
    }
</style>
@endsection

@section('content')
@component('components.breadcrumb')
    @slot('li_1') Khách hàng @endslot
    @slot('title') Chi tiết khách hàng @endslot
@endcomponent

<div class="customer-detail-container" style="background-color: #99FFFF;">
    <div class="card customer-detail-card">
        <div class="card-body">
            <div class="customer-info">
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <th>Mã khách hàng</th>
                            <td>{{ $khachHang->id }}</td>
                        </tr>
                        <tr>
                            <th>Tên khách hàng</th>
                            <td>{{ $khachHang->ten }}</td>
                        </tr>
                        <tr>
                            <th>Số điện thoại</th>
                            <td>{{ $khachHang->so_dien_thoai }}</td>
                        </tr>
                        <tr>
                            <th>Địa chỉ</th>
                            <td>{{ $khachHang->dia_chi }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <a href="{{ route('khach-hang.index') }}" class="btn btn-secondary btn-back">
                <i class="bx bx-arrow-back"></i> Trở về
            </a>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
@endsection
