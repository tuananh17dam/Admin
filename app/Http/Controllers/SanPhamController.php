<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm.
     */
    public function index()
    {
        // Lấy tất cả sản phẩm từ cơ sở dữ liệu
        $sanPhams = SanPham::all();

        // Trả về view và truyền dữ liệu sản phẩm
        return view('remake.san-pham.danh-sach-san-pham', compact('sanPhams'));
    }

    /**
     * Xóa sản phẩm theo ID.
     */
    public function destroy($id)
    {
        // Tìm sản phẩm theo ID
        $sanPham = SanPham::findOrFail($id);

        // Xóa sản phẩm
        $sanPham->delete();

        // Chuyển hướng về trang danh sách sản phẩm với thông báo thành công
        return redirect()->route('san-pham.index')->with('success', 'Xóa sản phẩm thành công!');
    }

    /**
     * Lưu sản phẩm mới.
     */
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu nhập vào
        $request->validate([
            'ten_san_pham' => 'required|string|max:255',
            'hinh_anh' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Kích thước tối đa 2MB
        ]);
    
        // Tạo sản phẩm mới
        $sanPham = new SanPham();
        $sanPham->ten_san_pham = $request->ten_san_pham;
        $sanPham->gia_nhap = $request->gia_nhap;
        $sanPham->gia_ban = $request->gia_ban;    
        // Xử lý hình ảnh
        if ($request->hasFile('hinh_anh')) {
            $path = $request->file('hinh_anh')->store('images/sanpham', 'public'); // Lưu vào storage/app/public/images/sanpham
            $sanPham->hinh_anh = 'storage/' . $path; // Đường dẫn công khai sẽ bắt đầu bằng storage/
        }
    
        $sanPham->save();
    
        return redirect()->route('san-pham.index')->with('success', 'Thêm sản phẩm thành công!');
    }
    

    /**
     * Hiển thị form thêm sản phẩm.
     */
    public function create()
    {
        return view('remake.san-pham.them-san-pham'); // Đường dẫn đến view thêm sản phẩm
    }

    /**
     * Hiển thị form sửa sản phẩm.
     */
    public function edit($id)
    {
        // Tìm sản phẩm theo ID
        $sanPham = SanPham::findOrFail($id);
        
        // Trả về view và truyền dữ liệu sản phẩm
        return view('remake.san-pham.sua-san-pham', compact('sanPham'));
    }

    /**
     * Cập nhật sản phẩm.
     */
    public function update(Request $request, $id)
    {
        // Kiểm tra dữ liệu nhập vào
        $request->validate([
            'ten_san_pham' => 'required|string|max:255',
            'hinh_anh' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Kích thước tối đa 2MB
        ]);
    
        // Tìm sản phẩm theo ID
        $sanPham = SanPham::findOrFail($id);
        $sanPham->ten_san_pham = $request->ten_san_pham;
        $sanPham->gia_nhap = $request->gia_nhap;
        $sanPham->gia_ban = $request->gia_ban;
    
        // Xử lý hình ảnh
        if ($request->hasFile('hinh_anh')) {
            $path = $request->file('hinh_anh')->store('images/sanpham', 'public'); // Lưu vào storage/app/public/images/sanpham
            $sanPham->hinh_anh = 'storage/' . $path; // Đường dẫn công khai sẽ bắt đầu bằng storage/
        }
    
        $sanPham->save();
    
        return redirect()->route('san-pham.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }
    
    public function show($id)
    {
        $sanPham = SanPham::findOrFail($id); // Lấy sản phẩm theo ID hoặc trả về lỗi 404
        return view('remake.san-pham.chi-tiet-san-pham', compact('sanPham'));
    }
}
