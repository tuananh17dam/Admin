<?php
namespace App\Http\Controllers;

use App\Models\KhoHang;
use App\Models\SanPham;
use Illuminate\Http\Request;

class KhoHangController extends Controller
{
    // Hiển thị danh sách kho hàng
    public function index()
    {
        $khoHangs = KhoHang::with('sanPham')->get();
        return view('remake.kho-hang.kho-hang', compact('khoHangs'));
    }

    // Hiển thị form tạo sản phẩm trong kho
    public function create()
    {
        $sanPhams = SanPham::all(); // Lấy danh sách sản phẩm để thêm vào kho
        return view('kho_hang.create', compact('sanPhams'));
    }

    // Lưu sản phẩm mới vào kho
    public function store(Request $request)
    {
        $validated = $request->validate([
            'san_pham_id' => 'required|exists:san_phams,id',
            'so_luong_ton_kho' => 'required|integer|min:0',
        ]);

        KhoHang::create($validated);

        return redirect()->route('kho-hang.index')->with('success', 'Thêm sản phẩm vào kho thành công');
    }

    // Hiển thị form chỉnh sửa số lượng sản phẩm trong kho
    public function edit(KhoHang $khoHang)
    {
        return view('kho_hang.edit', compact('khoHang'));
    }

    // Cập nhật thông tin sản phẩm trong kho
    public function update(Request $request, KhoHang $khoHang)
    {
        $validated = $request->validate([
            'so_luong_ton_kho' => 'required|integer|min:0',
        ]);

        $khoHang->update($validated);

        return redirect()->route('kho-hang.index')->with('success', 'Cập nhật số lượng thành công');
    }

    // Xóa sản phẩm khỏi kho
    public function destroy(KhoHang $khoHang)
    {
        $khoHang->delete();
        return redirect()->route('kho-hang.index')->with('success', 'Xóa sản phẩm khỏi kho thành công');
    }
}
