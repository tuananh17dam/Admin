<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\DonHangSanPham;
use App\Models\KhachHang;
use App\Models\SanPham;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    public function index()
    {
        $donHangs = DonHang::with('sanPhams')->get(); // Lấy cả danh sách sản phẩm trong từng đơn hàng
        return view('remake.don-hang.danh-sach-don-hang', compact('donHangs'));
    }

    public function create()
    {
        $khachHangs = KhachHang::all();
        $sanPhams = SanPham::all();
        return view('remake.don-hang.them-don-hang', compact('khachHangs', 'sanPhams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'khach_hang_id' => 'required|exists:khach_hangs,id',
            'san_pham_id' => 'required|array',
            'san_pham_id.*' => 'required|exists:san_phams,id',
            'so_luong' => 'required|array',
            'so_luong.*' => 'required|integer|min:1',
            'tin_nhan' => 'nullable|string',
            'voucher' => 'nullable|numeric',
            'sale' => 'nullable|numeric',
            'diem_thuong' => 'nullable|numeric',
            'phi_van_chuyen' => 'nullable|numeric',
            'voucher_van_chuyen' => 'nullable|numeric',
            'don_vi_van_chuyen' => 'required|string',
            'phuong_thuc_thanh_toan' => 'required|string',
            'tinh_trang' => 'required|string',
        ]);

        // Tính tổng thanh toán
        $tongThanhToan = $this->calculateTotal($request);

        // Tạo đơn hàng
        $donHang = DonHang::create(array_merge(
            $request->only([
                'khach_hang_id',
                'tin_nhan',
                'voucher',
                'sale',
                'diem_thuong',
                'phi_van_chuyen',
                'voucher_van_chuyen',
                'don_vi_van_chuyen',
                'phuong_thuc_thanh_toan',
                'tinh_trang'
            ]),
            ['tong_thanh_toan' => $tongThanhToan]
        ));

        // Thêm sản phẩm vào đơn hàng
        foreach ($request->san_pham_id as $index => $sanPhamId) {
            $sanPham = SanPham::findOrFail($sanPhamId);
            $soLuong = $request->so_luong[$index];
            $thanhTien = $sanPham->gia_ban * $soLuong;

            DonHangSanPham::create([
                'don_hang_id' => $donHang->id,
                'san_pham_id' => $sanPhamId,
                'so_luong' => $soLuong,
                'thanh_tien' => $thanhTien,
            ]);
        }

        return redirect()->route('don-hang.index')->with('success', 'Thêm đơn hàng thành công!');
    }


    private function calculateTotal($request)
    {
        $total = 0;

        // Kiểm tra xem san_pham_id có phải là một mảng không
        if (is_array($request->san_pham_id) && !empty($request->san_pham_id)) {
            foreach ($request->san_pham_id as $index => $sanPhamId) {
                $soLuong = $request->so_luong[$index] ?? 0; // Đảm bảo có giá trị mặc định cho số lượng
                $sanPham = SanPham::find($sanPhamId);

                // Kiểm tra xem sản phẩm có tồn tại không
                if ($sanPham) {
                    $total += $soLuong * $sanPham->gia_ban;
                }
            }
        }

        // Tính tổng sau khi trừ các khoản
        return max(0, $total - ($request->voucher ?? 0) - ($request->sale ?? 0) + ($request->phi_van_chuyen ?? 0) - ($request->diem_thuong ?? 0) - ($request->voucher_van_chuyen ?? 0));
    }

    public function show($id)
    {
        $donHang = DonHang::with('sanPhams')->findOrFail($id);
        return view('remake.don-hang.chi-tiet-don-hang', compact('donHang'));
    }

    public function edit($id)
    {
        $donHang = DonHang::with('sanPhams')->findOrFail($id); // Lấy đơn hàng cùng danh sách sản phẩm
        $khachHangs = KhachHang::all();
        $sanPhams = SanPham::all();
        $donHangSanPham = DonHangSanPham::all();
    
        return view('remake.don-hang.sua-don-hang', compact('donHang', 'khachHangs', 'sanPhams','donHangSanPham'));
    }
    
    public function update(Request $request, $id)
{
    // Xác thực dữ liệu từ request
    $request->validate([
        'khach_hang_id' => 'required|exists:khach_hangs,id',
        'san_pham_id' => 'required|array',
        'san_pham_id.*' => 'required|exists:san_phams,id',
        'so_luong' => 'required|array',
        'so_luong.*' => 'required|integer|min:1',
        'tin_nhan' => 'nullable|string',
        'voucher' => 'nullable|numeric',
        'sale' => 'nullable|numeric',
        'diem_thuong' => 'nullable|numeric',
        'phi_van_chuyen' => 'nullable|numeric',
        'voucher_van_chuyen' => 'nullable|numeric',
        'don_vi_van_chuyen' => 'required|string',
        'phuong_thuc_thanh_toan' => 'required|string',
        'tinh_trang' => 'required|string',
    ]);

    // Tính tổng thanh toán mới
    $tongThanhToan = $this->calculateTotal($request);

    // Cập nhật thông tin đơn hàng
    $donHang = DonHang::findOrFail($id);
    $donHang->update(array_merge(
        $request->only([
            'khach_hang_id',
            'tin_nhan',
            'voucher',
            'sale',
            'diem_thuong',
            'phi_van_chuyen',
            'voucher_van_chuyen',
            'don_vi_van_chuyen',
            'phuong_thuc_thanh_toan',
            'tinh_trang'
        ]),
        ['tong_thanh_toan' => $tongThanhToan] // Cập nhật tổng thanh toán
    ));

    // Cập nhật danh sách sản phẩm
    $sanPhamIds = $request->san_pham_id;
    $soLuongs = $request->so_luong;

    // Xóa các sản phẩm cũ trong đơn hàng
    $donHang->sanPhams()->detach();

    // Thêm sản phẩm mới vào đơn hàng
    foreach ($sanPhamIds as $index => $sanPhamId) {
        $sanPham = SanPham::findOrFail($sanPhamId);
        $soLuong = $soLuongs[$index];
        $thanhTien = $sanPham->gia_ban * $soLuong;

        DonHangSanPham::create([
            'don_hang_id' => $donHang->id,
            'san_pham_id' => $sanPhamId,
            'so_luong' => $soLuong,
            'thanh_tien' => $thanhTien,
        ]);
    }

    return redirect()->route('don-hang.index')->with('success', 'Đơn hàng đã được cập nhật');
}

    
    

    public function destroy(DonHang $donHang)
    {
        // Xóa các sản phẩm liên quan trong đơn hàng trước
        $donHang->sanPhams()->detach();

        // Xóa đơn hàng
        $donHang->delete();

        return redirect()->route('don-hang.index')->with('success', 'Xóa đơn hàng thành công!');
    }
}
