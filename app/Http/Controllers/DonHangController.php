<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\DonHangSanPham;
use App\Models\KhachHang;
use App\Models\SanPham;
use App\Models\User;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    public function index()
    {
        $donHangs = DonHang::with('sanPhams')->get();
        return view('remake.don-hang.danh-sach-don-hang', compact('donHangs'));
    }

    public function create()
    {
        $khachHangs = KhachHang::all();
        $sanPhams = SanPham::all();
        $users = User::all();
        return view('remake.don-hang.them-don-hang', compact('khachHangs', 'sanPhams', 'users'));
    }

    public function store(Request $request)
    {
        // Kiểm tra dữ liệu nhận được
        //dd($request->all());

        $this->validateRequest($request);

        $tongThanhToan = $this->calculateTotal($request);

        $donHang = DonHang::create(array_merge(
            $request->only([
                'khach_hang_id',
                'user_id',
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

        $this->addProductsToOrder($request, $donHang);

        return redirect()->route('don-hang.index')->with('success', 'Thêm đơn hàng thành công!');
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'khach_hang_id' => 'required|exists:khach_hangs,id',
            'user_id' => 'required|exists:users,id',
            'tin_nhan' => 'nullable|string',
            'voucher' => 'nullable|numeric',
            'sale' => 'nullable|numeric',
            'diem_thuong' => 'nullable|numeric',
            'don_vi_van_chuyen' => 'required|string',
            'phi_van_chuyen' => 'nullable|numeric',
            'voucher_van_chuyen' => 'nullable|numeric',
            'phuong_thuc_thanh_toan' => 'required|string',
            'tinh_trang' => 'required|string',
            'san_pham_id' => 'required|array',
            'san_pham_id.*' => 'required|exists:san_phams,id',
            'so_luong' => 'required|array',
            'so_luong.*' => 'required|integer|min:1',
        ]);
    }

    private function addProductsToOrder(Request $request, DonHang $donHang)
    {
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
    }

    private function calculateTotal(Request $request)
    {
        $total = 0;

        if (is_array($request->san_pham_id) && !empty($request->san_pham_id)) {
            foreach ($request->san_pham_id as $index => $sanPhamId) {
                $soLuong = $request->so_luong[$index] ?? 0;
                $sanPham = SanPham::find($sanPhamId);

                if ($sanPham) {
                    $total += $soLuong * $sanPham->gia_ban;
                }
            }
        }

        return max(0, $total - ($request->voucher ?? 0) - ($request->sale ?? 0) + ($request->phi_van_chuyen ?? 0) - ($request->diem_thuong ?? 0) - ($request->voucher_van_chuyen ?? 0));
    }

    public function show($id)
    {
        $donHang = DonHang::with('sanPhams')->findOrFail($id);
        return view('remake.don-hang.chi-tiet-don-hang', compact('donHang'));
    }

    public function edit($id)
    {
        $donHang = DonHang::with('sanPhams')->findOrFail($id);
        $khachHangs = KhachHang::all();
        $users = User::all();
        $sanPhams = SanPham::all();

        return view('remake.don-hang.sua-don-hang', compact('donHang', 'khachHangs', 'sanPhams', 'users'));
    }

    public function update(Request $request, $id)
    { //dd($request->all()); 
        $this->validateRequest($request);

        $tongThanhToan = $this->calculateTotal($request);

        $donHang = DonHang::findOrFail($id);
        $donHang->update(array_merge(
            $request->only([
                'khach_hang_id',
                'user_id',
                'tin_nhan',
                'voucher',
                'sale',
                'diem_thuong',
                'don_vi_van_chuyen',
                'phi_van_chuyen',
                'voucher_van_chuyen',
                'phuong_thuc_thanh_toan',
                'tinh_trang'
            ]),
            ['tong_thanh_toan' => $tongThanhToan]
        ));

        $this->updateProductsInOrder($request, $donHang);

        return redirect()->route('don-hang.index')->with('success', 'Đơn hàng đã được cập nhật');
    }

    private function updateProductsInOrder(Request $request, DonHang $donHang)
    {
        $sanPhamIds = $request->san_pham_id;
        $soLuongs = $request->so_luong;

        $donHang->sanPhams()->detach();

        $this->addProductsToOrder($request, $donHang);
    }

    public function destroy($id)
    {
        $donHang = DonHang::findOrFail($id);
        $donHang->sanPhams()->detach();
        $donHang->delete();

        return redirect()->route('don-hang.index')->with('success', 'Xóa đơn hàng thành công!');

        

        // Kiểm tra xem đơn hàng có phải của seller hiện tại không
        // if ($donHang->user_id !== Auth::id()) {
        //     abort(403); // Không có quyền truy cập
        // }

        // $donHang->sanPhams()->detach();
        // $donHang->delete();

        // return redirect()->route('donhang-seller.index')->with('success', 'Xóa đơn hàng thành công!');
    }
}
