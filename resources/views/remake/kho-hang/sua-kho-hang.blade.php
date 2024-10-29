@extends('layouts.master')

@section('title') Chỉnh sửa sản phẩm trong kho @endsection

@section('content')
    <div class="container">
        <h2>Chỉnh sửa số lượng sản phẩm</h2>
        <form action="{{ route('kho-hang.update', $khoHang->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="so_luong_ton_kho">Số lượng tồn kho</label>
                <input type="number" name="so_luong_ton_kho" id="so_luong_ton_kho" class="form-control" value="{{ $khoHang->so_luong_ton_kho }}" required>
            </div>
            <button type="submit" class="alert alert-info">Cập nhật</button>
        </form>
    </div>
@endsection
