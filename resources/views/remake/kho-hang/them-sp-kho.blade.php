@extends('layouts.master')

@section('title') Thêm sản phẩm vào kho @endsection

@section('content')
    <div class="container">
        <h2>Thêm sản phẩm vào kho</h2>
        <form action="{{ route('kho-hang.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="san_pham_id">Sản phẩm</label>
                <select name="san_pham_id" id="san_pham_id" class="form-control">
                    @foreach($sanPhams as $sanPham)
                        <option value="{{ $sanPham->id }}">{{ $sanPham->ten_san_pham }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="so_luong_ton_kho">Số lượng tồn kho</label>
                <input type="number" name="so_luong_ton_kho" id="so_luong_ton_kho" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Thêm</button>
        </form>
    </div>
@endsection
