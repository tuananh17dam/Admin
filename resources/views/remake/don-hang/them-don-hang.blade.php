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
                    <!-- Chọn khách hàng -->
                    <div class="mb-3">
                        <label for="khach_hang_id" class="form-label">Khách hàng</label>
                        <select name="khach_hang_id" id="khach_hang_id" class="form-control" required>
                            <option value="">Chọn khách hàng</option>
                            @foreach ($khachHangs as $khachHang)
                            <option value="{{ $khachHang->id }}">{{ $khachHang->ten }}</option>
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
                                {{-- Các dòng sản phẩm sẽ được thêm vào đây --}}
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary" id="themSanPham">Thêm sản phẩm</button>
                    </div>

                    <div class="mb-3">
                        <label for="tin_nhan" class="form-label">Tin nhắn</label>
                        <textarea name="tin_nhan" id="tin_nhan" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="voucher" class="form-label">Voucher</label>
                        <input type="number" name="voucher" id="voucher" class="form-control" value="0" min="0"
                            onchange="calculateTotal()">
                    </div>

                    <div class="mb-3">
                        <label for="sale" class="form-label">Sale</label>
                        <input type="number" name="sale" id="sale" class="form-control" value="0" min="0"
                            onchange="calculateTotal()">
                    </div>

                    <div class="mb-3">
                        <label for="diem_thuong" class="form-label">Điểm thưởng</label>
                        <input type="number" name="diem_thuong" id="diem_thuong" class="form-control" value="0" min="0"
                            onchange="calculateTotal()">
                    </div>

                    <div class="mb-3">
                        <label for="phi_van_chuyen" class="form-label">Phí vận chuyển</label>
                        <input type="number" name="phi_van_chuyen" id="phi_van_chuyen" class="form-control" value="0"
                            min="0" onchange="calculateTotal()">
                    </div>

                    <div class="mb-3">
                        <label for="voucher_van_chuyen" class="form-label">Voucher vận chuyển</label>
                        <input type="number" name="voucher_van_chuyen" id="voucher_van_chuyen" class="form-control"
                            value="0" min="0" onchange="calculateTotal()">
                    </div>

                    <div class="mb-3">
                        <label for="don_vi_van_chuyen" class="form-label">Đơn vị vận chuyển</label>
                        <input type="text" name="don_vi_van_chuyen" id="don_vi_van_chuyen" class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="phuong_thuc_thanh_toan" class="form-label">Phương thức thanh toán</label>
                        <select name="phuong_thuc_thanh_toan" id="phuong_thuc_thanh_toan" class="form-control" required>
                            <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                            <option value="Zalopay">Zalopay</option>
                            <option value="Ví điện tử MoMo">Ví điện tử MoMo</option>
                            <option value="Thẻ tín dụng/ghi nợ nội địa">Thẻ tín dụng/ghi nợ nội địa</option>
                            <option value="Thẻ ATM nội địa">Thẻ ATM nội địa</option>
                            <option value="VNPAY">VNPAY</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tinh_trang" class="form-label">Tình trạng</label>
                        <select name="tinh_trang" id="tinh_trang" class="form-control" required>
                            <option value="chua_giao">Chưa giao</option>
                            <option value="da_giao">Đã giao</option>
                            <option value="huy_don">Hủy đơn</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tong_thanh_toan" class="form-label">Tổng thanh toán</label>
                        <input type="text" name="tong_thanh_toan" id="tong_thanh_toan" class="form-control" readonly>
                    </div>

                    <button type="submit" class="btn btn-success">Thêm đơn hàng</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('themSanPham').addEventListener('click', function () {
        let sanPhamRow = `
            <tr>
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
                    <span class="gia-ban">0 VNĐ</span>
                </td>
                <td>
                    <span class="thanh-tien">0 VNĐ</span>
                </td>
                <td>
                    <button type="button" class="btn btn-danger xoa-san-pham">Xóa</button>
                </td>
            </tr>
        `;
        document.getElementById('sanPhamList').insertAdjacentHTML('beforeend', sanPhamRow);
    });

    document.getElementById('sanPhamList').addEventListener('change', function (e) {
        const row = e.target.closest('tr');
        const soLuongInput = row.querySelector('.so-luong');
        const sanPhamSelect = row.querySelector('.san-pham');

        if (e.target.matches('.san-pham')) {
            const selectedOption = sanPhamSelect.options[sanPhamSelect.selectedIndex];
            const giaBan = parseFloat(selectedOption.dataset.gia);
            const tenSanPham = selectedOption.text; // Lấy tên sản phẩm

            row.querySelector('.gia-ban').textContent = giaBan.toFixed(0) + ' VNĐ';
            soLuongInput.value = 1; // Reset số lượng về 1 khi chọn sản phẩm mới
            calculateTotal(row);
        } 
        document.getElementById('sanPhamList').addEventListener('blur', function (e) {
    if (e.target.matches('.so-luong')) {
        const row = e.target.closest('tr');
        const soLuongInput = row.querySelector('.so-luong');
        let soLuong = parseFloat(soLuongInput.value) || 0;

        // Kiểm tra sau khi người dùng rời khỏi ô nhập liệu
        if (soLuong < 1) {
            alert("Số lượng sản phẩm không được nhỏ hơn 1. Tự động điều chỉnh về 1.");
            soLuong = 1;
            soLuongInput.value = 1;
        }

        const giaBan = parseFloat(row.querySelector('.gia-ban').textContent.replace(' VNĐ', '').replace(',', '')) || 0;
        const thanhTien = soLuong * giaBan;
        row.querySelector('.thanh-tien').textContent = thanhTien.toFixed(0) + ' VNĐ';

        // Cập nhật tổng tiền
        calculateTotal();
    }
}, true); // Sử dụng sự kiện nổi để bắt sự kiện blur


        document.getElementById('sanPhamList').addEventListener('input', function (e) {
    if (e.target.matches('.so-luong')) {
        const row = e.target.closest('tr');
        const soLuongInput = row.querySelector('.so-luong');
        let soLuong = parseFloat(soLuongInput.value) || 0;

        // Đảm bảo số lượng không âm
        

        const giaBan = parseFloat(row.querySelector('.gia-ban').textContent.replace(' VNĐ', '').replace(',', '')) || 0;
        const thanhTien = soLuong * giaBan;
        row.querySelector('.thanh-tien').textContent = thanhTien.toFixed(0) + ' VNĐ';
        calculateTotal();
    }
});

    });

    document.getElementById('sanPhamList').addEventListener('click', function (e) {
        if (e.target.matches('.xoa-san-pham')) {
            e.target.closest('tr').remove();
            calculateTotal();
        }
    });

    window.calculateTotal = function() {
    let tongThanhToan = 0;
    const sanPhamRows = document.querySelectorAll('#sanPhamList tr');

    // Tính tổng thành tiền các sản phẩm
    sanPhamRows.forEach(row => {
        const soLuong = parseFloat(row.querySelector('.so-luong').value) || 0;
        const giaBan = parseFloat(row.querySelector('.gia-ban').textContent.replace(' VNĐ', '').replace(',', '')) || 0;
        const thanhTien = soLuong * giaBan;
        row.querySelector('.thanh-tien').textContent = thanhTien.toFixed(0) + ' VNĐ';

        tongThanhToan += thanhTien;
    });

    // Lấy giá trị của các input khác
    let voucher = parseFloat(document.getElementById('voucher').value) || 0;
    let sale = parseFloat(document.getElementById('sale').value) || 0;
    let diemThuong = parseFloat(document.getElementById('diem_thuong').value) || 0;
    let phiVanChuyen = parseFloat(document.getElementById('phi_van_chuyen').value) || 0;
    let voucherVanChuyen = parseFloat(document.getElementById('voucher_van_chuyen').value) || 0;

    // Kiểm tra và đảm bảo các giá trị hợp lệ
    if (voucher < 0) voucher = 0;
    if (sale < 0) sale = 0;
    if (diemThuong < 0) diemThuong = 0;
    if (phiVanChuyen < 0) phiVanChuyen = 0;
    if (voucherVanChuyen > phiVanChuyen) voucherVanChuyen = phiVanChuyen;
    

    // Nếu voucher là phần trăm, tính giá trị giảm giá
    if (voucher > 0 && voucher <= 100) {
        voucher = tongThanhToan * (voucher / 100);
    }

    // Tính tổng thanh toán
    tongThanhToan = tongThanhToan - voucher - sale - diemThuong + phiVanChuyen - voucherVanChuyen;

    // Đảm bảo tổng thanh toán không âm
    if (tongThanhToan < 0) tongThanhToan = 0;

    // Cập nhật giá trị cho ô tổng thanh toán
    document.getElementById('tong_thanh_toan').value = tongThanhToan.toFixed(0) + ' VNĐ';
};


});

</script>
@endsection