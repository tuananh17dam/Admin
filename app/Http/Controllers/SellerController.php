<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerOrderController extends Controller
{
    // Hiển thị danh sách đơn hàng của seller đang đăng nhập
    public function index()
    {
        $orders = DonHang::where('user_id', Auth::id())->get();
        return view('remake.seller.orders.so_index', compact('orders'));
    }

    // Hiển thị form để tạo đơn hàng mới
    public function create()
    {
        return view('remake.seller.orders.so_create');
    }

    // Xử lý lưu đơn hàng mới
    public function store(Request $request)
    {
        $request->validate([
            'khach_hang_id' => 'required|exists:khach_hangs,id',
            'tin_nhan' => 'nullable|string',
            'voucher' => 'nullable|integer|min:0',
            'sale' => 'nullable|integer|min:0',
            'diem_thuong' => 'nullable|integer|min:0',
            'don_vi_van_chuyen' => 'required|string',
            'phi_van_chuyen' => 'nullable|integer|min:0',
            'voucher_van_chuyen' => 'nullable|integer|min:0',
            'tong_thanh_toan' => 'required|integer|min:0',
            'phuong_thuc_thanh_toan' => 'required|in:Thanh toán khi nhận hàng,Zalopay,Ví điện tử MoMo,Thẻ tín dụng/ghi nợ nội địa,Thẻ ATM nội địa,VNPAY',
            'tinh_trang' => 'nullable|in:Chưa giao,Đã giao,Hủy đơn,Hoàn hàng'
        ]);

        // Tạo đơn hàng mới với user_id là ID của seller hiện tại
        DonHang::create([
            'khach_hang_id' => $request->khach_hang_id,
            'user_id' => Auth::id(),
            'tin_nhan' => $request->tin_nhan,
            'voucher' => $request->voucher ?? 0,
            'sale' => $request->sale ?? 0,
            'diem_thuong' => $request->diem_thuong ?? 0,
            'don_vi_van_chuyen' => $request->don_vi_van_chuyen,
            'phi_van_chuyen' => $request->phi_van_chuyen ?? 0,
            'voucher_van_chuyen' => $request->voucher_van_chuyen ?? 0,
            'tong_thanh_toan' => $request->tong_thanh_toan,
            'phuong_thuc_thanh_toan' => $request->phuong_thuc_thanh_toan,
            'tinh_trang' => $request->tinh_trang ?? 'Chưa giao'
        ]);

        return redirect()->route('donhang-seller.index')->with('success', 'Đơn hàng đã được tạo thành công.');
    }

    // Hiển thị form để chỉnh sửa đơn hàng của seller
    public function edit($id)
    {
        $order = DonHang::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('remake.seller.orders.so_edit', compact('order'));
    }

    // Xử lý cập nhật đơn hàng
    public function update(Request $request, $id)
    {
        $order = DonHang::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'tin_nhan' => 'nullable|string',
            'voucher' => 'nullable|integer|min:0',
            'sale' => 'nullable|integer|min:0',
            'diem_thuong' => 'nullable|integer|min:0',
            'don_vi_van_chuyen' => 'required|string',
            'phi_van_chuyen' => 'nullable|integer|min:0',
            'voucher_van_chuyen' => 'nullable|integer|min:0',
            'tong_thanh_toan' => 'required|integer|min:0',
            'phuong_thuc_thanh_toan' => 'required|in:Thanh toán khi nhận hàng,Zalopay,Ví điện tử MoMo,Thẻ tín dụng/ghi nợ nội địa,Thẻ ATM nội địa,VNPAY',
            'tinh_trang' => 'nullable|in:Chưa giao,Đã giao,Hủy đơn,Hoàn hàng'
        ]);

        $order->update([
            'tin_nhan' => $request->tin_nhan,
            'voucher' => $request->voucher ?? 0,
            'sale' => $request->sale ?? 0,
            'diem_thuong' => $request->diem_thuong ?? 0,
            'don_vi_van_chuyen' => $request->don_vi_van_chuyen,
            'phi_van_chuyen' => $request->phi_van_chuyen ?? 0,
            'voucher_van_chuyen' => $request->voucher_van_chuyen ?? 0,
            'tong_thanh_toan' => $request->tong_thanh_toan,
            'phuong_thuc_thanh_toan' => $request->phuong_thuc_thanh_toan,
            'tinh_trang' => $request->tinh_trang ?? 'Chưa giao'
        ]);

        return redirect()->route('donhang-seller.index')->with('success', 'Đơn hàng đã được cập nhật thành công.');
    }

    // Xóa đơn hàng của seller
    public function destroy($id)
    {
        $order = DonHang::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $order->delete();

        return redirect()->route('donhang-seller.index')->with('success', 'Đơn hàng đã được xóa thành công.');
    }
}
