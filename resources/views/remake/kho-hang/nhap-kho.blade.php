@extends('layouts.master')

@section('title') Nhập hàng vào kho @endsection

@section('content')
<div class="container">
    <h2>Thêm sản phẩm vào kho</h2>
    <form action="{{ route('kho-hang.store') }}" method="POST" id="nhapHangForm">
        @csrf

        <!-- Chọn tên sản phẩm -->
        <div class="form-group">
            <label for="ten_san_pham">Tên sản phẩm</label>
            <select name="san_pham_id" id="ten_san_pham" class="form-control" required>
                <option value="">Chọn sản phẩm</option>
                @foreach ($sanPhams as $sanPham)
                    <option value="{{ $sanPham->id }}" data-ma-san-pham="{{ $sanPham->ID }}" data-so-luong-ton="{{ $sanPham->khoHang->so_luong_ton_kho ?? 0 }}">
                        {{ $sanPham->ten_san_pham }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Mã sản phẩm sẽ tự động hiện lên khi chọn tên sản phẩm -->
        <div class="form-group">
            <label for="ma_san_pham">Mã sản phẩm</label>
            <input type="text" name="ma_san_pham" id="ma_san_pham" class="form-control" readonly>
        </div>

        <!-- Số lượng tồn kho ban đầu -->
        <div class="form-group">
            <label for="so_luong_ton_kho">Số lượng tồn kho</label>
            <input type="number" name="so_luong_ton_kho" id="so_luong_ton_kho" class="form-control" readonly>
        </div>

        <!-- Số lượng nhập -->
        <div class="form-group">
            <label for="so_luong_nhap">Số lượng nhập vào</label>
            <input type="number" name="so_luong_nhap" id="so_luong_nhap" class="form-control" value="0" min="0" required>
        </div>

        <!-- Tổng số lượng sau khi nhập -->
        <div class="form-group">
            <label for="tong_so_luong">Tổng số lượng sau khi nhập</label>
            <input type="number" name="tong_so_luong" id="tong_so_luong" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-info">Cập nhật</button>
    </form>
</div>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tenSanPhamSelect = document.getElementById('ten_san_pham');
        const maSanPhamInput = document.getElementById('ma_san_pham');
        const soLuongTonKhoInput = document.getElementById('so_luong_ton_kho');
        const soLuongNhapInput = document.getElementById('so_luong_nhap');
        const tongSoLuongInput = document.getElementById('tong_so_luong');

        // Khi chọn sản phẩm, cập nhật mã sản phẩm và số lượng tồn kho
        tenSanPhamSelect.addEventListener('change', function () {
            const selectedOption = tenSanPhamSelect.options[tenSanPhamSelect.selectedIndex];
            maSanPhamInput.value = selectedOption.getAttribute('data-ma-san-pham') || '';
            soLuongTonKhoInput.value = selectedOption.getAttribute('data-so-luong-ton') || 0;
            updateTongSoLuong();
        });

        // Tính toán tổng số lượng tự động
        function updateTongSoLuong() {
            const soLuongTonKho = parseInt(soLuongTonKhoInput.value) || 0;
            const soLuongNhap = parseInt(soLuongNhapInput.value) || 0;
            const tongSoLuong = soLuongTonKho + soLuongNhap;
            tongSoLuongInput.value = tongSoLuong;
        }

        // Gọi hàm tính toán khi người dùng nhập số lượng nhập
        soLuongNhapInput.addEventListener('input', updateTongSoLuong);
    });
</script>
@endsection
