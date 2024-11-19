@extends('layouts.master')

@section('title') Danh sách tài khoản @endsection

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
        text-align: center;
        font-weight: bold;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    td,
    th {
        text-align: center;
        vertical-align: middle;
    }

    .address-cell {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        max-width: 300px;
        /* Điều chỉnh chiều rộng tối đa cho địa chỉ */
    }

    .phone-cell {
        max-width: 150px;
        /* Điều chỉnh chiều rộng tối đa cho số điện thoại */
    }

    .email-cell {
        max-width: 200px;
        /* Điều chỉnh chiều rộng tối đa cho email */
    }

    .action-buttons .btn {
        margin-right: 5px;
        font-size: 12px;
        /* Giảm kích thước chữ cho nút hành động */
    }
</style>
@endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Tài khoản @endslot
@slot('title') Danh sách Tài khoản @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="row mb-4">
                    <div class="col-sm">
                        <a href=" {{ route('user.create') }} " class="btn btn-primary">
                            <i class="bx bx-plus me-1"></i> Thêm Tài khoản
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle datatable dt-responsive nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="text-align: center;">ID</th>
                                <th style="text-align: center;">Tên Tài khoản</th>
                                <th style="text-align: center;">Địa chỉ</th>
                                <th style="text-align: center;" class="phone-cell">Số điện thoại</th>
                                <th style="text-align: center;" class="email-cell">Email</th>
                                <th style="text-align: center;">Vai trò</th>
                                <th style="text-align: center;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td class="address-cell">{{ $user->address }}</td>
                                <td class="phone-cell">{{ $user->phone }}</td>
                                <td class="email-cell">{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td class="action-buttons">
                                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-sm">Chi tiết</a>
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')">Xóa</button>
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

@endsection