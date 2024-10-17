@extends('layouts.master')

@section('title') Thêm đơn hàng @endsection

@section('content')

@component('components.breadcrumb')
    @slot('li_1') Đơn hàng @endslot
    @slot('title') Thêm đơn hàng @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('don-hang.store') }}" method="POST" id="donHangForm">
                    @csrf
                    <div class="mb-3">
                        <label for="khach_hang_id" class="form-label">Khách hàng</label>
                        <select name="khach_hang_id" id="khach_hang_id" class="form-control" required>
                            <option value="">Chọn khách hàng</option>
                            @foreach ($khachHangs as $khachHang)
                                <option value="{{ $khachHang->id }}">{{ $khachHang->ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="san_pham_id" class="form-label">Sản phẩm</label>
                        <select name="san_pham_id" id="san_pham_id" class="form-control" required>
                            <option value="">Chọn sản phẩm</option>
                            @foreach ($sanPhams as $sanPham)
                                <option value="{{ $sanPham->id }}" data-gia-ban="{{ $sanPham->gia_ban }}">{{ $sanPham->ten_san_pham }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="so_luong" class="form-label">Số lượng</label>
                        <input type="number" name="so_luong" id="so_luong" class="form-control" required min="1">
                    </div>
                    <div class="mb-3">
                        <label for="vocher" class="form-label">Voucher</label>
                        <input type="number" name="vocher" id="vocher" class="form-control" step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="thanh_tien" class="form-label">Thành tiền</label>
                        <input type="number" name="thanh_tien" id="thanh_tien" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="don_vi_van_chuyen" class="form-label">Đơn vị vận chuyển</label>
                        <input type="text" name="don_vi_van_chuyen" id="don_vi_van_chuyen" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tinh_trang" class="form-label">Tình trạng</label>
                        <select name="tinh_trang" id="tinh_trang" class="form-control" required>
                            <option value="chua_giao">Chưa giao</option>
                            <option value="da_giao">Đã giao</option>
                            <option value="huy_don">Hủy đơn</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm đơn hàng</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('script')
<script>
    function calculateTotal() {
        const sanPhamSelect = document.getElementById('san_pham_id');
        const soLuongInput = document.getElementById('so_luong');
        const vocherInput = document.getElementById('vocher');
        const thanhTienInput = document.getElementById('thanh_tien');

        const sanPhamGiaBan = sanPhamSelect.options[sanPhamSelect.selectedIndex].dataset.giaBan;
        const soLuong = parseInt(soLuongInput.value) || 0;
        const vocher = parseFloat(vocherInput.value) || 0;

        // Tính thành tiền
        const thanhTien = (sanPhamGiaBan * soLuong) - vocher;

        // Cập nhật vào ô thành tiền
        thanhTienInput.value = thanhTien >= 0 ? thanhTien.toFixed(2) : 0;
    }

    // Lắng nghe sự kiện input
    document.getElementById('so_luong').addEventListener('input', calculateTotal);
    document.getElementById('vocher').addEventListener('input', calculateTotal);
    document.getElementById('san_pham_id').addEventListener('change', calculateTotal);
</script>
@endsection

@endsection