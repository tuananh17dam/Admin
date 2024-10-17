@extends('layouts.master')

@section('title') Danh sách khách hàng @endsection

@section('css')
    <!-- flatpickr css -->
    <link href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        /* Custom styles for the customer list table */
        .table thead th {
            background-color: #f8f9fa;
            color: #495057;
            text-align: center; /* Căn giữa tiêu đề */
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table img {
            max-width: 100px;
            border-radius: 5px;
        }

        .action-buttons .btn {
            margin-right: 5px;
        }

        /* Căn giữa cột mã khách hàng và các cột khác */
        td, th {
            text-align: center; /* Căn giữa nội dung cột */
        }

        /* Giảm kích thước cột mã khách hàng */
        th:nth-child(2), td:nth-child(2) {
            width: 60px; /* Giảm chiều rộng cột mã khách hàng */
        }

        /* Ẩn phần địa chỉ không cần thiết */
        .address-cell {
            overflow: hidden; /* Ẩn phần địa chỉ */
            white-space: nowrap; /* Không xuống dòng */
            text-overflow: ellipsis; /* Hiển thị dấu '...' khi vượt quá */
            max-width: 150px; /* Giới hạn chiều rộng tối đa của địa chỉ */
        }

        /* Ẩn thanh cuộn ngang cho bảng */
        .table-responsive {
            overflow-x: hidden; /* Ẩn thanh cuộn ngang */
        }
    </style>
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Khách hàng @endslot
        @slot('title') Danh sách khách hàng @endslot
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
                            <a href="them-khach-hang" class="btn btn-light waves-effect waves-light">
                                <i class="bx bx-plus me-1"></i> Thêm khách hàng
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle datatable dt-responsive table-check nowrap" style="width: 100%;">
                            <thead>
                                <tr class="bg-transparent">
                                    <th style="width: 5px;">
                                        <div class="form-check font-size-16">
                                            <input type="checkbox" name="check" class="form-check-input" id="checkAll" onclick="toggle(this)">
                                            <label class="form-check-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    < <th style="width: 5px; text-align: center;">ID</th> <!-- Giảm chiều rộng cột -->
                                    <th style="text-align: center; width: 150px;">Tên khách hàng</th>
                                    <th style="width: 150px; text-align: center;">Số điện thoại</th>
                                    <th style="text-align: center;">Địa chỉ</th>
                                    <th style="width: 90px; text-align: center;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($khachHangs as $khachHang)
                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="check_{{ $khachHang->id }}" name="ids[]" value="{{ $khachHang->id }}">
                                                <label  class="form-check-label" for="check_{{ $khachHang->id }}" style="text-align: center;"></label>
                                            </div>
                                        </td>
                                        <td  style="width: 5px;" >{{ $khachHang->id }}</td>
                                        <td style="text-align: center";>{{ $khachHang->ten }}</td>
                                        <td style="text-align: center;">{{ $khachHang->so_dien_thoai }}</td>
                                        <td class="address-cell">{{ $khachHang->dia_chi }}</td> <!-- Thêm class để ẩn phần địa chỉ -->
                                        <td class="action-buttons">
                                            <a href="{{ route('khach-hang.show', $khachHang->id) }}" class="btn btn-info btn-sm">Xem Chi Tiết</a>
                                            <a href="{{ route('khach-hang.edit', $khachHang->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                                            <form action="{{ route('khach-hang.destroy', $khachHang->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa khách hàng này?')">Xóa</button>
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
    <!-- flatpickr js -->
    <script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- init js -->
    <script src="{{ URL::asset('build/js/pages/invoices-list.init.js') }}"></script>

    <script>
        function toggle(source) {
            checkboxes = document.querySelectorAll('input[name="ids[]"]');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = source.checked;
            });
        }
    </script>
@endsection
