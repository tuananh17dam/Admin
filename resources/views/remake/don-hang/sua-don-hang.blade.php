@extends('layouts.master')

@section('title') Sửa đơn hàng @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Đơn hàng @endslot
@slot('title') Sửa đơn hàng @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('don-hang.update', $donHang->id) }}" method="POST" id="donHangForm">
                    @csrf
                    @method('PUT')

                    <!-- Chọn khách hàng -->
                    <div class="mb-3">
                        <label for="khach_hang_id" class="form-label">Khách hàng</label>
                        <select name="khach_hang_id" id="khach_hang_id" class="form-control" required>
                            <option value="">Chọn khách hàng</option>
                            @foreach ($khachHangs as $khachHang)
                            <option value="{{ $khachHang->id }}" {{ $donHang->khach_hang_id == $khachHang->id ? 'selected' : '' }}>
                                {{ $khachHang->ten }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Danh sách sản phẩm -->
                    <div class="mb-3">
                        <label class="form-label">Danh sách sản phẩm</label>
                        <table class="table table-bordered" id="sanPhamTable">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá bán</th>
                                    <th>Thành tiền</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="sanPhamList">
                                @foreach ($donHang->donHangSanPhams as $donHangSanPham)
                                <tr>
                                    <td>
                                        <select name="san_pham_id[]" class="form-control san-pham" required>
                                            <option value="">Chọn sản phẩm</option>
                                            @foreach ($sanPhams as $sanPham)
                                            <option value="{{ $sanPham->id }}" {{ $donHangSanPham->san_pham_id == $sanPham->id ? 'selected' : '' }} data-gia="{{ $sanPham->gia_ban }}">
                                                {{ $sanPham->ten_san_pham }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="so_luong[]" class="form-control so-luong" min="1" value="{{ $donHangSanPham->so_luong }}" required>
                                    </td>
                                    <td>
                                        <span class="gia-ban">{{ number_format($donHangSanPham->sanPham->gia_ban, 0, ',', '.') }} VNĐ</span>
                                    </td>
                                    <td>
                                        <span class="thanh-tien">{{ number_format($donHangSanPham->thanh_tien, 0, ',', '.') }} VNĐ</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger xoa-san-pham">Xóa</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary" id="themSanPham">Thêm sản phẩm</button>
                    </div>

                    <!-- Tin nhắn -->
                    <div class="mb-3">
                        <label for="tin_nhan" class="form-label">Tin nhắn</label>
                        <textarea name="tin_nhan" id="tin_nhan" class="form-control" rows="3">{{ $donHang->tin_nhan }}</textarea>
                    </div>

                    <!-- Voucher -->
                    <div class="mb-3">
                        <label for="voucher" class="form-label">Voucher</label>
                        <input type="number" name="voucher" id="voucher" class="form-control" value="{{ $donHang->voucher }}" min="0">
                    </div>

                    <!-- Sale -->
                    <div class="mb-3">
                        <label for="sale" class="form-label">Sale</label>
                        <input type="number" name="sale" id="sale" class="form-control" value="{{ $donHang->sale }}" min="0">
                    </div>

                    <!-- Điểm thưởng -->
                    <div class="mb-3">
                        <label for="diem_thuong" class="form-label">Điểm thưởng</label>
                        <input type="number" name="diem_thuong" id="diem_thuong" class="form-control" value="{{ $donHang->diem_thuong }}" min="0">
                    </div>

                    <!-- Phí vận chuyển -->
                    <div class="mb-3">
                        <label for="phi_van_chuyen" class="form-label">Phí vận chuyển</label>
                        <input type="number" name="phi_van_chuyen" id="phi_van_chuyen" class="form-control" value="{{ $donHang->phi_van_chuyen }}" min="0">
                    </div>

                    <!-- Voucher vận chuyển -->
                    <div class="mb-3">
                        <label for="voucher_van_chuyen" class="form-label">Voucher vận chuyển</label>
                        <input type="number" name="voucher_van_chuyen" id="voucher_van_chuyen" class="form-control" value="{{ $donHang->voucher_van_chuyen }}" min="0">
                    </div>

                    <!-- Đơn vị vận chuyển -->
                    <div class="mb-3">
                        <label for="don_vi_van_chuyen" class="form-label">Đơn vị vận chuyển</label>
                        <input type="text" name="don_vi_van_chuyen" id="don_vi_van_chuyen" class="form-control" value="{{ $donHang->don_vi_van_chuyen }}" required>
                    </div>

                    <!-- Phương thức thanh toán -->
                    <div class="mb-3">
                        <label for="phuong_thuc_thanh_toan" class="form-label">Phương thức thanh toán</label>
                        <select name="phuong_thuc_thanh_toan" id="phuong_thuc_thanh_toan" class="form-control" required>
                            <option value="Thanh toán khi nhận hàng" {{ $donHang->phuong_thuc_thanh_toan == 'Thanh toán khi nhận hàng' ? 'selected' : '' }}>Thanh toán khi nhận hàng</option>
                            <option value="Zalopay" {{ $donHang->phuong_thuc_thanh_toan == 'Zalopay' ? 'selected' : '' }}>Zalopay</option>
                            <option value="Ví điện tử MoMo" {{ $donHang->phuong_thuc_thanh_toan == 'Ví điện tử MoMo' ? 'selected' : '' }}>Ví điện tử MoMo</option>
                            <option value="Thẻ tín dụng/ghi nợ nội địa" {{ $donHang->phuong_thuc_thanh_toan == 'Thẻ tín dụng/ghi nợ nội địa' ? 'selected' : '' }}>Thẻ tín dụng/ghi nợ nội địa</option>
                            <option value="Thẻ ATM nội địa" {{ $donHang->phuong_thuc_thanh_toan == 'Thẻ ATM nội địa' ? 'selected' : '' }}>Thẻ ATM nội địa</option>
                            <option value="VNPAY" {{ $donHang->phuong_thuc_thanh_toan == 'VNPAY' ? 'selected' : '' }}>VNPAY</option>
                        </select>
                    </div>

                    <!-- Tình trạng -->
                    <div class="mb-3">
                        <label for="tinh_trang" class="form-label">Tình trạng</label>
                        <select name="tinh_trang" id="tinh_trang" class="form-control" required>
                            <option value="chua_giao" {{ $donHang->tinh_trang == 'chua_giao' ? 'selected' : '' }}>Chưa giao</option>
                            <option value="da_giao" {{ $donHang->tinh_trang == 'da_giao' ? 'selected' : '' }}>Đã giao</option>
                            <option value="huy_don" {{ $donHang->tinh_trang == 'huy_don' ? 'selected' : '' }}>Hủy đơn</option>
                        </select>
                    </div>

                    <!-- Tổng thanh toán -->
                    <div class="mb-3">
                        <label for="tong_thanh_toan" class="form-label">Tổng thanh toán</label>
                        <input type="text" name="tong_thanh_toan" id="tong_thanh_toan" class="form-control" value="{{ number_format($donHang->tong_thanh_toan, 0, ',', '.') }} VNĐ" readonly>
                    </div>

                    <button type="submit" class="btn btn-success">Cập nhật đơn hàng</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    // Tính thành tiền
    function tinhThanhTien() {
        let tongThanhToan = 0;
        const rows = document.querySelectorAll('#sanPhamList tr');

        rows.forEach(row => {
            const soLuong = row.querySelector('.so-luong').value;
            const giaBan = row.querySelector('.san-pham option:checked').dataset.gia;
            const thanhTien = soLuong * giaBan;
            row.querySelector('.thanh-tien').innerText = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(thanhTien);
            tongThanhToan += thanhTien;
        });

        const voucher = parseFloat(document.getElementById('voucher').value) || 0;
        const sale = parseFloat(document.getElementById('sale').value) || 0;
        const phiVanChuyen = parseFloat(document.getElementById('phi_van_chuyen').value) || 0;
        const voucherVanChuyen = parseFloat(document.getElementById('voucher_van_chuyen').value) || 0;

        tongThanhToan =  tongThanhToan - voucher -  sale + phiVanChuyen - voucherVanChuyen;
        

        document.getElementById('tong_thanh_toan').value = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(tongThanhToan);
    }

    // Sự kiện thay đổi số lượng và sản phẩm
    document.addEventListener('change', function(event) {
        if (event.target.classList.contains('so-luong') || event.target.classList.contains('san-pham')) {
            tinhThanhTien();
        }
    });

    // Thêm sản phẩm mới
    document.getElementById('themSanPham').addEventListener('click', function() {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <select name="san_pham_id[]" class="form-control san-pham" required>
                    <option value="">Chọn sản phẩm</option>
                    @foreach ($sanPhams as $sanPham)
                    <option value="{{ $sanPham->id }}" data-gia="{{ $sanPham->gia_ban }}">{{ $sanPham->ten_san_pham }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="so_luong[]" class="form-control so-luong" min="1" value="1" required>
            </td>
            <td>
                <span class="gia-ban"></span>
            </td>
            <td>
                <span class="thanh-tien">{{ number_format(0, 0, ',', '.') }} VNĐ</span>
            </td>
            <td>
                <button type="button" class="btn btn-danger xoa-san-pham">Xóa</button>
            </td>
        `;
        document.getElementById('sanPhamList').appendChild(newRow);
        tinhThanhTien();
    });

    // Xóa sản phẩm
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('xoa-san-pham')) {
            event.target.closest('tr').remove();
            tinhThanhTien();
        }
    });

    // Tính toán tổng thanh toán khi trang được tải
    window.onload = function() {
        tinhThanhTien();
    };

    // Tính toán tổng thanh toán khi thay đổi giá trị voucher, sale, phí vận chuyển
    document.getElementById('voucher').addEventListener('input', tinhThanhTien);
    document.getElementById('sale').addEventListener('input', tinhThanhTien);
    document.getElementById('phi_van_chuyen').addEventListener('input', tinhThanhTien);
    document.getElementById('voucher_van_chuyen').addEventListener('input', tinhThanhTien);
</script>
@endsection
