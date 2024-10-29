@extends('layouts.master')

@section('title') Danh sách kho hàng @endsection

@section('content')
    <div class="container">
        <h2 style="text-align: center;">Danh sách sản phẩm trong kho</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('kho-hang.create') }}" class="btn btn-success">Thêm sản phẩm vào kho</a>
            <a href="{{ route('kho-hang.create') }}" class="btn btn-success">Sản phẩm hết</a>
        </div>
        
        <br>
        <br>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng tồn kho</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($khoHangs as $khoHang)
                <tr>
                    <td>{{ $khoHang->sanPham->ten_san_pham }}</td>
                    <td>{{ $khoHang->so_luong_ton_kho }}</td>
                    <td>
                        <a href="{{ route('kho-hang.edit', $khoHang->id) }}" class="btn btn-primary">Sửa</a>
                        <form action="{{ route('kho-hang.destroy', $khoHang->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
