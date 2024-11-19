@extends('layouts.master')

@section('title')Danh sách sản phẩm hết hàng @endsection

@section('css')
    <!-- flatpickr css -->
    <link href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Kho hàng @endslot
        @slot('title') Danh sách sản phẩm hết hàng  @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table align-middle datatable dt-responsive table-check nowrap" style="width: 100%;">
                            <thead>
                                <tr class="bg-transparent">
                                    <th style="text-align: center;">Tên sản phẩm</th>
                                    <th style="text-align: center;">Mã sản phẩm</th>
                                    <th style="text-align: center;">Số lượng tồn kho</th>
                                    <th style="text-align: center;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($khoHangs as $khoHang)
                                    <tr>
                                        <td style="text-align: center;">{{ $khoHang->sanPham->ten_san_pham }}</td>
                                        <td style="text-align: center;">{{ $khoHang->san_pham_id }}</td>
                                        <td style="text-align: center;">{{ $khoHang->so_luong_ton_kho }}</td>
                                        <td class="action-buttons" style="text-align: center;">
                                            <a href="{{ route('kho-hang.edit', $khoHang->id) }}" class="btn btn-primary btn-sm">Nhập hàng</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
@endsection
