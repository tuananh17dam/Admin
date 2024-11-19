@extends('layouts.master')

@section('title') Chi tiết đơn hàng @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Đơn hàng @endslot
@slot('title') Chi tiết đơn hàng @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between mb-4">
                    <h4>Chi tiết đơn hàng #{{ $donHang->id }}</h4>
                    <a href="{{ route('donhang-seller.index') }}" class="btn btn-secondary">
                        <i class="bx bx-arrow-back"></i> Quay lại
                    </a>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h5>Thông tin khách hàng</h5>
                        <p><strong>Tên: </strong>{{ $donHang->khachHang->ten }}</p>
                        <p><strong>Số điện thoại: </strong>{{ $donHang->khachHang->so_dien_thoai }}</p>
                        <p><strong>Địa chỉ: </strong>{{ $donHang->khachHang->dia_chi }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Thông tin đơn hàng</h5>
                        <p><strong>Ngày đặt hàng: </strong>{{ $donHang->created_at->format('d-m-Y') }}</p>
                        <p><strong>Lời nhắn: </strong>{{ $donHang->tin_nhan }}</p>
                        <p><strong>Tình trạng: </strong>{{ ucfirst($donHang->tinh_trang) }}</p>
                    </div>
                    <br>
                    <br>
                    <div class="col-md-6">
                        <h5>Thông tin nhà bán hàng</h5>
                        <p><strong>Tên: </strong>{{ $donHang->user->name }}</p>
                        <p><strong>Số điện thoại: </strong>{{ $donHang->user->phone }}</p>
                        <p><strong>Emai: </strong>{{ $donHang->user->email }}</p>
                        <p><strong>Địa chỉ: </strong>{{ $donHang->user->address }}</p>

                    </div>
                </div>

                <hr>

                <h5>Sản phẩm trong đơn hàng</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Tên sản phẩm</th>
                                <th style="text-align: center;">Số lượng</th>
                                <th style="text-align: center;">Giá</th>
                                <th style="text-align: center;">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donHang->donHangSanPhams as $dhsp)
                            <tr>
                                <td style="text-align: center;">{{ $dhsp->sanPham->ten_san_pham }}</td>
                                <td style="text-align: center;">{{ $dhsp->so_luong }}</td>
                                <td style="text-align: center;">{{ number_format($dhsp->sanPham->gia_ban, 0, ',', '.')
                                    }} VND</td>
                                <td style="text-align: center;">{{ number_format($dhsp->so_luong *
                                    $dhsp->sanPham->gia_ban, 0, ',', '.') }} VND</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div> 
                <div style="text-align: right;">
                    <p><strong>Chiết khấu từ người bán: </strong>-{{ number_format($donHang->sale, 0, ',', '.') }} VND</p>
                    <p><strong>Voucher: </strong>-{{ number_format($donHang->voucher, 0, ',', '.') }} VND</p>
                    <p><strong>Đơn vị vận chuyển: </strong>{{ $donHang->don_vi_van_chuyen }}</p>
                    <p><strong>Phí vận chuyển: </strong>{{ number_format($donHang->phi_van_chuyen, 0, ',', '.') }} VND</p>
                    <p><strong>Voucher vận chuyển: </strong>-{{ number_format($donHang->voucher_van_chuyen, 0, ',', '.') }} VND</p>
                    <p><strong>Phương thức thanh toán: </strong>{{ $donHang->phuong_thuc_thanh_toan }}</p>
                    <p><sp style="font-size: 1.5em; font-weight: bold; color: #0e1dcb;">Tổng thanh toán: </sp>{{ number_format($donHang->tong_thanh_toan, 0, ',', '.') }} VND</p>
              <div class="d-print-none mt-4">
                    <a href="javascript:window.print()" class="btn btn-success">
                        <i class="fa fa-print"></i> In hóa đơn
                    </a>
                </div>  </div>
                

            </div>
        </div>
    </div>
</div>

@endsection