@extends('layouts.master')

@section('title') Danh sách đơn hàng @endsection

@section('css')
    <!-- flatpickr css -->
    <link href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        /* Custom styles for the order list table */
        .table thead th {
            background-color: #f8f9fa;
            color: #495057;
            text-align: center; /* Căn giữa tiêu đề */
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons .btn {
            margin-right: 5px;
        }

        /* Căn giữa cột mã đơn hàng và các cột khác */
        td th {
             text-align: center;
        }
        th {
            text-align: center; /* Căn giữa nội dung cột */
        }

        /* Giảm kích thước cột mã đơn hàng */
        th:nth-child(2), td:nth-child(2) {
            width: 60px; /* Giảm chiều rộng cột mã đơn hàng */
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
                            <a href="them-don-hang" class="btn btn-light waves-effect waves-light">
                                <i class="bx bx-plus me-1"></i> Thêm đơn hàng
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle datatable dt-responsive table-check nowrap" style="width: 100%;">
                            <thead>
                                <tr class="bg-transparent">
                                    {{-- <th style="width: 5px;">
                                        <div class="form-check font-size-16">
                                            <input type="checkbox" name="check" class="form-check-input" id="checkAll" onclick="toggle(this)">
                                            <label class="form-check-label" for="checkAll"></label>
                                        </div>
                                    </th> --}}
                                    <th style="width: 5px; text-align: center;">ID</th> <!-- Giảm chiều rộng cột -->
                                    <th style="width: 150px; text-align: center;">Khách hàng</th>
                                    <th style="width: 150px; text-align: center;">Sản phẩm</th>
                                    <th style="width: 100px; text-align: center;">Số lượng</th>
                                    <th style="width: 100px; text-align: center;">Thành tiền</th>
                                    <th style="width: 150px; text-align: center;">Đơn vị vận chuyển</th>
                                    <th style="width: 100px; text-align: center;">Tình trạng</th>
                                    <th style="width: 90px; text-align: center;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donHangs as $donHang)
                                    <tr>
                                        {{-- <td>
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="check_{{ $donHang->id }}" name="ids[]" value="{{ $donHang->id }}">
                                                <label class="form-check-label" for="check_{{ $donHang->id }}"></label>
                                            </div>
                                        </td> --}}
                                        <td style="text-align: center;">{{ $donHang->id }}</td>
                                        <td style="text-align: center;">{{ $donHang->khachHang->ten }}</td>
                                        <td style="text-align: center;" >{{ $donHang->sanPham->ten_san_pham }}</td>
                                        <td style="text-align: center;" >{{ $donHang->so_luong }}</td>
                                        <td style="text-align: center;" >{{ number_format($donHang->thanh_tien, 0, ',', '.') }} VND</td>
                                        <td style="text-align: center;" >{{ $donHang->don_vi_van_chuyen }}</td>
                                        <td style="text-align: center;" >{{ ucfirst($donHang->tinh_trang) }}</td>
                                        <td class="action-buttons">
                                             <a href="{{ route('don-hang.show', $donHang->id) }}" class="btn btn-info btn-sm">Xem Chi Tiết</a> 
                                             <a href="{{ route('don-hang.edit', $donHang->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                                            <form action="{{ route('don-hang.destroy', $donHang->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">Xóa</button>
                                                
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
