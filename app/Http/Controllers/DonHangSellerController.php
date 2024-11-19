<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\DonHangSanPham;
use App\Models\KhachHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonHangSellerController extends Controller
{
    public function index()
    {
        // Lấy các đơn hàng mà seller hiện tại đã tạo
        $userId = Auth::id();
        $donHangs = DonHang::with('sanPhams')->where('user_id', $userId)->get();

        return view('remake.seller.oders.so_index', compact('donHangs'));
    }

    public function create()
    {
        $khachHangs = KhachHang::all();
        $sanPhams = SanPham::all();
        return view('remake.seller.oders.so_create', compact('khachHangs', 'sanPhams'));
    }

    public function store(Request $request)
    {
        // Kiểm tra dữ liệu nhận được
        $this->validateRequest($request);

        $tongThanhToan = $this->calculateTotal($request);

        // Lưu đơn hàng với user_id là seller hiện tại
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
                'tinh_trang',
                'user_id' // Lưu ID của seller hiện tại
            ]),
            ['tong_thanh_toan' => $tongThanhToan]
        ));

        $this->addProductsToOrder($request, $donHang);

        return redirect()->route('donhang-seller.index')->with('success', 'Thêm đơn hàng thành công!');
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'khach_hang_id' => 'required|exists:khach_hangs,id',
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
        
        // Kiểm tra xem đơn hàng có phải của seller hiện tại không
        if ($donHang->user_id !== Auth::id()) {
            abort(403); // Không có quyền truy cập
        }

        return view('remake.seller.oders.chi-tiet-don-hang', compact('donHang'));
    }

    public function edit($id)
    {
        $donHang = DonHang::with('sanPhams')->findOrFail($id);

        // Kiểm tra xem đơn hàng có phải của seller hiện tại không
        if ($donHang->user_id !== Auth::id()) {
            abort(403); // Không có quyền truy cập
        }

        $khachHangs = KhachHang::all();
        $sanPhams = SanPham::all();

        return view('remake.seller.oders.so_edit', compact('donHang', 'khachHangs', 'sanPhams'));
    }

    public function update(Request $request, $id)
    {
        $this->validateRequest($request);

        $tongThanhToan = $this->calculateTotal($request);

        $donHang = DonHang::findOrFail($id);

        // Kiểm tra xem đơn hàng có phải của seller hiện tại không
        if ($donHang->user_id !== Auth::id()) {
            abort(403); // Không có quyền truy cập
        }

        $donHang->update(array_merge(
            $request->only([
                'khach_hang_id',
                'tin_nhan',
                'voucher',
                'sale',
                'diem_thuong',
                'don_vi_van_chuyen',
                'phi_van_chuyen',
                'voucher_van_chuyen',
                'phuong_thuc_thanh_toan',
                'tinh_trang',
            ]),
            ['tong_thanh_toan' => $tongThanhToan]
        ));

        $this->updateProductsInOrder($request, $donHang);

        return redirect()->route('donhang-seller.index')->with('success', 'Đơn hàng đã được cập nhật');
    }

    private function updateProductsInOrder(Request $request, DonHang $donHang)
    {
        // Xóa các sản phẩm cũ
        $donHang->sanPhams()->detach();

        // Thêm lại các sản phẩm mới
        $this->addProductsToOrder($request, $donHang);
    }

    public function destroy($id)
    {
        $donHang = DonHang::findOrFail($id);

        // Kiểm tra xem đơn hàng có phải của seller hiện tại không
        if ($donHang->user_id !== Auth::id()) {
            abort(403); // Không có quyền truy cập
        }

        $donHang->sanPhams()->detach();
        $donHang->delete();

        return redirect()->route('donhang-seller.index')->with('success', 'Xóa đơn hàng thành công!');
    }
}
