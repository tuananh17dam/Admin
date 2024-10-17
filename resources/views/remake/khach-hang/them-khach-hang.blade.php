@extends('layouts.master')
@section('title', 'Thêm khách hàng')

@section('content')
    <h1>Thêm khách hàng</h1>

    <form action="{{ route('them-khach-hang.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="ten" class="form-label">Tên khách hàng</label>
            <input type="text" class="form-control" id="ten" name="ten" required>
        </div>
    
        <div class="mb-3">
            <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" required>
        </div>
    
        <div class="mb-3">
            <label for="dia_chi" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="dia_chi" name="dia_chi" required>
        </div>
    
        <button type="submit" class="btn btn-success">Thêm khách hàng</button>

        <a href="{{ route('khach-hang.index') }}" class="btn btn-secondary">Hủy</a>
    </div>
    </form>
    
@endsection

