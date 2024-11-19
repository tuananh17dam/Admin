@extends('layouts.master')

@section('title') Danh sách đơn hàng @endsection

@section('css')
<!-- flatpickr css -->
<link href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<!-- DataTables -->
<link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
    rel="stylesheet" type="text/css" />

<style>
    /* Căn giữa tiêu đề và nội dung bảng */
    table th,
    table td {
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
    }

    /* Màu nền tiêu đề */
    .table thead th {
        background-color: #f8f9fa;
        color: #495057;
    }

    /* Hiệu ứng hover cho hàng */
    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Căn chỉnh các nút hành động */
    .action-buttons .btn {
        margin-right: 5px;
    }

    .ellipsis {
        white-space: nowrap;
        /* Không cho phép xuống dòng */
        overflow: hidden;
        /* Ẩn nội dung tràn ra ngoài */
        text-overflow: ellipsis;
        /* Hiển thị dấu '...' khi nội dung quá dài */
        max-width: 180px;
        /* Giới hạn chiều rộng của cột */
    }

    /* Điều chỉnh kích thước các cột */
    th:nth-child(1),
    td:nth-child(1) {
        width: 50px;
    }

    
    th:nth-child(2),
    td:nth-child(2) {
        width: 120px;
    }

    th:nth-child(3),
    td:nth-child(3) {
        width: 120px;
    }

   

    th:nth-child(4),
    td:nth-child(4) {
        width: 120px;
    }

    th:nth-child(5),
    td:nth-child(5) {
        width: 200px;
    }

</style>
@endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Đơn hàng @endslot
@slot('title') Danh sách đơn hàng @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <!-- Thông báo thành công -->
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="row mb-4">
                    <div class="col-sm">
                        <a href=" {{ route('donhang-seller.create')}}" class="btn btn-light waves-effect waves-light">
                            <i class="bx bx-plus me-1"></i> Thêm đơn hàng
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle datatable dt-responsive table-check nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="text-align: center">ID</th>
                                <th style="text-align: center">Khách hàng</th>
        
                                <th style="text-align: center  ;width: 600px; ">Sản phẩm</th>
                                <th style="text-align: center">PT thanh toán</th>
                                <th style="text-align: center">Tổng thanh toán</th>
                                <th style="text-align: center">Tình trạng</th>
                                <th style="text-align: center;">Ngày đặt</th>
                                <th style="text-align: center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donHangs as $donHang)
                            <tr>
                                <td>{{ $donHang->id }}</td>
                                <td class="ellipsis">{{ $donHang->khachHang->ten }}</td>
                                
                                <td class="ellipsis">@foreach ($donHang->donHangSanPhams as $dhsp)
                                    <div>
                                        <span>{{ $dhsp->sanPham->ten_san_pham }}</span>-
                                        <span>{{ $dhsp->so_luong }}</span> 
                                        <!-- <span>Giá: {{ number_format($dhsp->sanPham->gia_ban, 0, ',', '.') }} VND</span> - -->
                                        <!-- <span>Thành tiền: {{ number_format($dhsp->so_luong * $dhsp->sanPham->gia_ban, 0, ',', '.') }} VND</span> -->
                                    </div>
                                    @endforeach</td>

                                <td class="ellipsis">{{ $donHang->phuong_thuc_thanh_toan}}</td>
                                <td>{{ number_format($donHang->tong_thanh_toan, 0, ',', '.') }} VND</td>
                                <td>{{ ucfirst($donHang->tinh_trang) }}</td>
                                <td>{{ $donHang->created_at->format('d-m-Y') }}</td>
                                <td class="action-buttons">
                                        <a href="{{ route('donhang-seller.show', $donHang->id) }}" class="btn btn-info btn-sm">
                                            Chi Tiết
                                        </a>
                                        <a href="{{ route('donhang-seller.edit', $donHang->id) }}" class="btn btn-primary btn-sm">
                                            Sửa
                                        </a>
                                        <form action="{{ route('donhang-seller.destroy', $donHang->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                                Xóa
                                            </button>
                                        </form>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end table responsive -->
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

@endsection

@section('script')
<script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/invoices-list.init.js') }}"></script>
@endsection