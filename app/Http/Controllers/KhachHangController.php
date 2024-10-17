<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;

class KhachHangController extends Controller
{
    // Hiển thị danh sách khách hàng
    public function index()
    {
        // Lấy tất cả khách hàng từ cơ sở dữ liệu
        $khachHangs = KhachHang::all();

        // Trả về view danh sách khách hàng với dữ liệu khách hàng
        return view('remake.khach-hang.danh-sach-khach-hang', compact('khachHangs'));
    }

    // Hiển thị form thêm khách hàng
    public function create()
    {
        // Trả về view form thêm khách hàng
        return view('remake.khach-hang.them-khach-hang');
    }

    // Lưu khách hàng mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'ten' => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|max:15',
            'dia_chi' => 'required|string|max:255',
        ]);

        // Tạo mới khách hàng
        KhachHang::create($request->all());

        // Chuyển hướng về trang danh sách khách hàng với thông báo thành công
        return redirect()->route('khach-hang.index')->with('success', 'Khách hàng đã được thêm.');
    }

    // Xóa khách hàng theo ID
    public function destroy($id)
    {
        // Tìm khách hàng theo ID
        $khachHang = KhachHang::findOrFail($id);

        // Xóa khách hàng
        $khachHang->delete();

        // Chuyển hướng trở lại trang danh sách khách hàng với thông báo thành công
        return redirect()->route('khach-hang.index')->with('success', 'Xóa khách hàng thành công.');
    }

    public function edit($id)
    {
        // Lấy thông tin khách hàng theo ID
        $khachHang = KhachHang::findOrFail($id);

        // Trả về view chỉnh sửa khách hàng
        return view('remake.khach-hang.sua-khach-hang', compact('khachHang'));
    }

    public function update(Request $request, $id)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'ten' => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|max:15',
            'dia_chi' => 'required|string|max:255',
        ]);

        // Lấy thông tin khách hàng theo ID
        $khachHang = KhachHang::findOrFail($id);

        // Cập nhật thông tin khách hàng
        $khachHang->update($request->all());

        // Chuyển hướng về trang danh sách khách hàng với thông báo thành công
        return redirect()->route('khach-hang.index')->with('success', 'Khách hàng đã được cập nhật.');
    }
    public function show($id)
    {
        $khachHang = KhachHang::findOrFail($id);
        return view('remake.khach-hang.chi-tiet-khach-hang', compact('khachHang'));
    }
}
