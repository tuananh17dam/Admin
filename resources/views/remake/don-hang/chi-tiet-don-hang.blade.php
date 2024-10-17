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
                        <a href="{{ route('don-hang.index') }}" class="btn btn-secondary">
                            <i class="bx bx-arrow-back"></i> Quay lại
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Thông tin khách hàng</h5>
                            <p><strong>Tên: </strong>{{ $donHang->khachHang->ten }}</p>
                            <p><strong>Email: </strong>{{ $donHang->khachHang->email }}</p>
                            <p><strong>Số điện thoại: </strong>{{ $donHang->khachHang->so_dien_thoai }}</p>
                            <p><strong>Địa chỉ: </strong>{{ $donHang->khachHang->dia_chi }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Thông tin đơn hàng</h5>
                            <p><strong>Ngày đặt hàng: </strong>{{ $donHang->created_at->format('F d, Y') }}</p>
                            <p><strong>Thành tiền: </strong>{{ number_format($donHang->thanh_tien, 0, ',', '.') }} VND</p>
                            <p><strong>Tình trạng: </strong>{{ ucfirst($donHang->tinh_trang) }}</p>
                            <p><strong>Đơn vị vận chuyển: </strong>{{ $donHang->don_vi_van_chuyen }}</p>
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
                                {{-- @foreach ($donHang->chiTietDonHang as $chiTiet)
                                    <tr>
                                        <td style="text-align: center;">{{ $chiTiet->sanPham->ten_san_pham }}</td>
                                        <td style="text-align: center;">{{ $chiTiet->so_luong }}</td>
                                        <td style="text-align: center;">{{ number_format($chiTiet->gia, 0, ',', '.') }} VND</td>
                                        <td style="text-align: center;">{{ number_format($chiTiet->thanh_tien, 0, ',', '.') }} VND</td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>

                    <div class="d-print-none mt-4">
                        <a href="javascript:window.print()" class="btn btn-success"><i class="fa fa-print"></i> In hóa đơn</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
