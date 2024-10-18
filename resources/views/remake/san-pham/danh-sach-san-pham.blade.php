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
        table-layout: fixed; /* Chia đều các cột */
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
        word-wrap: break-word; /* Bẻ dòng nếu nội dung quá dài */
    }
    .table tbody tr:hover {
        background-color: #f1f1f1;
    }
    .table img {
        max-width: 80px;
        height: auto;
        border-radius: 5px;
    }
    .action-buttons .btn {
        margin-right: 5px;
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
                        <a href="them-san-pham" class="btn btn-light waves-effect waves-light">
                            <i class="bx bx-plus me-1"></i> Thêm sản phẩm
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle datatable dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align: center;"> 
                                    <div class="form-check font-size-16">
                                        <input type="checkbox" name="check" class="form-check-input" id="checkAll" onclick="toggle(this)">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th style="width: 5%; text-align: center;">ID</th>
                                <th style="width: 30%; text-align: center;">Tên sản phẩm</th>
                                {{-- <th style="width: 30%; text-align: center;">Giá nhập</th> --}}
                                <th style="width: 30%; text-align: center;">Giá bán</th>
                                <th style="width: 25%; text-align: center;">Hình ảnh</th>
                                <th style="width: 20%; text-align: center;">Hành động</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($sanPhams as $sanPham)
                            <tr>
                                <td>
                                    <div class="form-check font-size-16">
                                        <input type="checkbox" class="form-check-input" id="check_{{ $sanPham->id }}" name="ids[]" value="{{ $sanPham->id }}">
                                        <label class="form-check-label" for="check_{{ $sanPham->id }}"></label>
                                    </div>
                                </td>
                                <td>{{ $sanPham->id }}</td>
                                <td>{{ $sanPham->ten_san_pham }}</td>
                                {{-- <td>{{ $sanPham->gia_nhap }}</td> --}}
                                <td>{{ $sanPham->gia_ban }}</td>
                                <td>
                                    <img src="{{ asset($sanPham->hinh_anh) }}" alt="{{ $sanPham->ten_san_pham }}">
                                </td>
                                <td class="action-buttons">
                                    <a href="{{ route('san-pham.show', $sanPham->id) }}" class="btn btn-info btn-sm">Xem chi tiết</a>
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
<script src="{{ URL::asset('build/js/pages/invoices-list.init.js') }}"></script>
<script>
    function toggle(source) {
        const checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = source.checked;
        });
    }
</script>
@endsection
