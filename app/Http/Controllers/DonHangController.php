<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\KhachHang; // Giả sử bạn cần lấy thông tin khách hàng
use App\Models\SanPham; // Giả sử bạn cần lấy thông tin sản phẩm
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donHangs = DonHang::with(['khachHang', 'sanPham'])->get();
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
        'san_pham_id' => 'required|exists:san_phams,id',
        'so_luong' => 'required|integer|min:1',
        'vocher' => 'nullable|numeric',
        'don_vi_van_chuyen' => 'required|string|max:255',
        'tinh_trang' => 'required|in:chua_giao,da_giao,huy_don',
    ]);

    // Lấy giá bán của sản phẩm
    $sanPham = SanPham::find($request->san_pham_id);
    $giaBan = $sanPham->gia_ban; // Giả sử bạn có thuộc tính gia_ban trong model SanPham

    // Tính thành tiền
    $thanhTien = ($request->so_luong * $giaBan) - $request->vocher;

    // Tạo đơn hàng mới
    DonHang::create([
        'khach_hang_id' => $request->khach_hang_id,
        'san_pham_id' => $request->san_pham_id,
        'so_luong' => $request->so_luong,
        'vocher' => $request->vocher ?? 0,
        'thanh_tien' => $thanhTien,
        'don_vi_van_chuyen' => $request->don_vi_van_chuyen,
        'tinh_trang' => $request->tinh_trang,
    ]);

    return redirect()->route('don-hang.index')->with('success', 'Thêm đơn hàng thành công!');
}
    /**
     * Display the specified resource.
     */
    public function show(DonHang $donHang)
    {
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
            'san_pham_id' => 'required|exists:san_phams,id',
            'so_luong' => 'required|integer|min:1',
            'vocher' => 'nullable|numeric',
            'thanh_tien' => 'required|numeric',
            'don_vi_van_chuyen' => 'required|string|max:255',
            'tinh_trang' => 'required|in:chua_giao,da_giao,huy_don',
        ]);

        $donHang->update($request->all());

        return redirect()->route('don-hang.index')->with('success', 'Cập nhật đơn hàng thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DonHang $donHang)
    {
        $donHang->delete();
        return redirect()->route('don-hang.index')->with('success', 'Xóa đơn hàng thành công!');
    }
}
