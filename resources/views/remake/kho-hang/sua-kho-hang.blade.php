@extends('layouts.master')

@section('title') Nhập hàng vào kho @endsection

@section('content')
    <div class="container">
        <h2>Nhập hàng vào kho</h2>
        <form action="{{ route('kho-hang.update', $khoHang->id) }}" method="POST" id="nhapHangForm">
            @csrf
            @method('PUT')

            <!-- Thông tin sản phẩm -->
            <div class="form-group">
                <label for="ten_san_pham">Tên sản phẩm</label>
                <input type="text" name="ten_san_pham" id="ten_san_pham" class="form-control" value="{{ $khoHang->sanPham->ten_san_pham }}" readonly>
            </div>
            
            <div class="form-group">
                <label for="ma_san_pham">Mã sản phẩm</label>
                <input type="text" name="ma_san_pham" id="ma_san_pham" class="form-control" value="{{ $khoHang->san_pham_id }}" readonly>
            </div>

            <!-- <div class="form-group">
                <label for="hinh_anh">Hình ảnh sản phẩm</label>
                <img src="{{ asset('storage/' . $khoHang->sanPham->hinh_anh) }}" alt="Hình ảnh sản phẩm" class="img-thumbnail" style="width: 200px; height: auto;">
            </div> -->

            <!-- Số lượng tồn kho ban đầu -->
            <div class="form-group">
                <label for="so_luong_ton_kho">Số lượng tồn kho</label>
                <input type="number" name="so_luong_ton_kho" id="so_luong_ton_kho" class="form-control" value="{{ $khoHang->so_luong_ton_kho }}" readonly>
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
    const soLuongTonKhoInput = document.getElementById('so_luong_ton_kho');
    const soLuongNhapInput = document.getElementById('so_luong_nhap');
    const tongSoLuongInput = document.getElementById('tong_so_luong');

    // Tính toán tổng số lượng tự động
    function updateTongSoLuong() {
        const soLuongTonKho = parseInt(soLuongTonKhoInput.value) || 0;
        const soLuongNhap = parseInt(soLuongNhapInput.value) || 0;
        const tongSoLuong = soLuongTonKho + soLuongNhap;
        tongSoLuongInput.value = tongSoLuong;
    }

    // Gọi hàm tính toán khi người dùng nhập số lượng nhập
    soLuongNhapInput.addEventListener('input', updateTongSoLuong);

    // Gọi hàm tính toán ban đầu
    updateTongSoLuong();
});
</script>
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