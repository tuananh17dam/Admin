@extends('layouts.master')
@section('css')
<link href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<style>
    /* Căn giữa và mở rộng chi tiết khách hàng */
    .customer-detail-container {
       
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .customer-detail-card {
        width: 60%; /* Tăng gấp đôi kích thước form */
        max-width: 800px;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .customer-info {
        font-size: 18px;
        color: #495057;
        margin-bottom: 20px;
    }

    .customer-info h5 {
        font-weight: bold;
        margin: 5px 0; /* Giảm khoảng cách trên và dưới */
    }

    .btn-back {
        display: block;
        margin-top: 5px;
    }
</style>
@endsection

@section('content')
@component('components.breadcrumb')
    @slot('li_1') Khách hàng @endslot
    @slot('title') Chi tiết khách hàng @endslot
@endcomponent

<div class="customer-detail-container">
    <div class="card customer-detail-card">
        <div class="card-body text-center">
            <div class="customer-info">
                <h5>Mã khách hàng:</h5>
                <p>{{ $khachHang->id }}</p>

                <h5>Tên khách hàng:</h5>
                <p>{{ $khachHang->ten }}</p>

                <h5>Số điện thoại:</h5>
                <p>{{ $khachHang->so_dien_thoai }}</p>

                <h5>Địa chỉ:</h5>
                <p>{{ $khachHang->dia_chi }}</p>
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
