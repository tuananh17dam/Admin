<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\KhachHang; // Giả sử bạn cần lấy thông tin khách hàng
use App\Models\SanPham; // Giả sử bạn cần lấy thông tin sản phẩm
use App\Models\DonHangSanPham; // Model cho bảng don_hang_san_pham
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donHangs = DonHang::all();
        return view('remake.don-hang.danh-sach-don-hang', compact('donHangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $khachHangs = KhachHang::all();
        $sanPhams = SanPham::all();
        return view('remake.don-hang.them-don-hang', compact('khachHangs', 'sanPhams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'khach_hang_id' => 'required|exists:khach_hangs,id',
            'san_pham' => 'required|array', // Nhận mảng sản phẩm
            'san_pham.*.id' => 'required|exists:san_phams,id',
            'san_pham.*.so_luong' => 'required|integer|min:1',
            'vocher' => 'nullable|numeric',
            'don_vi_van_chuyen' => 'required|string|max:255',
            'tinh_trang' => 'required|in:chua_giao,da_giao,huy_don',
        ]);

        // Tạo đơn hàng mới
        $donHang = DonHang::create([
            'khach_hang_id' => $request->khach_hang_id,
            'vocher' => $request->vocher ?? 0,
            'don_vi_van_chuyen' => $request->don_vi_van_chuyen,
            'tinh_trang' => $request->tinh_trang,
        ]);

        // Tính tổng thành tiền cho từng sản phẩm và lưu vào bảng don_hang_san_pham
        $tongThanhToan = 0;
        foreach ($request->san_pham as $item) {
            $sanPham = SanPham::find($item['id']);
            $giaBan = $sanPham->gia_ban; // Giả sử bạn có thuộc tính gia_ban trong model SanPham

            // Tính thành tiền cho sản phẩm
            $thanhTien = ($item['so_luong'] * $giaBan);
            $tongThanhToan += $thanhTien;

            // Lưu thông tin sản phẩm vào bảng don_hang_san_pham
            $donHang->sanPhams()->attach($sanPham->id, ['so_luong' => $item['so_luong']]);
        }

        // Cập nhật tổng thanh toán cho đơn hàng
        $donHang->update(['thanh_tien' => $tongThanhToan]);

        return redirect()->route('don-hang.index')->with('success', 'Thêm đơn hàng thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Tìm đơn hàng theo ID và lấy danh sách sản phẩm kèm theo
        $donHang = DonHang::with('donHangSanPhams.sanPham')->findOrFail($id);

        // Trả về view với dữ liệu đơn hàng và sản phẩm
        return view('remake.don-hang.chi-tiet-don-hang', compact('donHang'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DonHang $donHang)
    {
        $khachHangs = KhachHang::all();
        $sanPhams = SanPham::all();
        return view('remake.don-hang.sua-don-hang', compact('donHang', 'khachHangs', 'sanPhams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DonHang $donHang)
    {
        $request->validate([
            'khach_hang_id' => 'required|exists:khach_hangs,id',
            'san_pham' => 'required|array',
            'san_pham.*.id' => 'required|exists:san_phams,id',
            'san_pham.*.so_luong' => 'required|integer|min:1',
            'vocher' => 'nullable|numeric',
            'don_vi_van_chuyen' => 'required|string|max:255',
            'tinh_trang' => 'required|in:chua_giao,da_giao,huy_don',
        ]);

        // Cập nhật thông tin đơn hàng
        $donHang->update([
            'khach_hang_id' => $request->khach_hang_id,
            'vocher' => $request->vocher ?? 0,
            'don_vi_van_chuyen' => $request->don_vi_van_chuyen,
            'tinh_trang' => $request->tinh_trang,
        ]);

        // Xóa tất cả sản phẩm hiện tại trong đơn hàng
        $donHang->sanPhams()->detach();

        // Tính tổng thành tiền cho từng sản phẩm và lưu vào bảng don_hang_san_pham
        $tongThanhToan = 0;
        foreach ($request->san_pham as $item) {
            $sanPham = SanPham::find($item['id']);
            $giaBan = $sanPham->gia_ban;

            // Tính thành tiền cho sản phẩm
            $thanhTien = ($item['so_luong'] * $giaBan);
            $tongThanhToan += $thanhTien;

            // Lưu thông tin sản phẩm vào bảng don_hang_san_pham
            $donHang->sanPhams()->attach($sanPham->id, ['so_luong' => $item['so_luong']]);
        }

        // Cập nhật tổng thanh toán cho đơn hàng
        $donHang->update(['thanh_tien' => $tongThanhToan]);

        return redirect()->route('don-hang.index')->with('success', 'Cập nhật đơn hàng thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DonHang $donHang)
    {
        $donHang->sanPhams()->detach(); // Xóa tất cả sản phẩm liên quan
        $donHang->delete();
        return redirect()->route('don-hang.index')->with('success', 'Xóa đơn hàng thành công!');
    }
}
