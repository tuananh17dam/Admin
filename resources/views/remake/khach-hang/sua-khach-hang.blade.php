@extends('layouts.master')

@section('title', 'Sửa khách hàng')

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Khách hàng @endslot
        @slot('title') Sửa khách hàng @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Form sửa khách hàng -->
                    <form action="{{ route('khach-hang.update', $khachHang->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="ten" class="form-label">Tên khách hàng</label>
                            <input type="text" class="form-control" id="ten" name="ten" value="{{ $khachHang->ten }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" value="{{ $khachHang->so_dien_thoai }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="dia_chi" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="dia_chi" name="dia_chi" value="{{ $khachHang->dia_chi }}" required>
                        </div>

                        <!-- Nút sửa và nút hủy -->
                        <button type="submit" class="btn btn-success">Sửa</button>
                        <a href="{{ route('khach-hang.index') }}" class="btn btn-secondary">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
