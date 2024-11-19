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
        return view('remake.kho-hang.nhap-kho', compact('sanPhams'));
    }

    // Lưu sản phẩm mới vào kho
    public function store(Request $request)
    {
        $request->validate([
            'san_pham_id' => 'required|exists:san_phams,id',
            'so_luong_nhap' => 'required|integer|min:0',
        ]);
    
        // Lấy thông tin sản phẩm từ kho
        $sanPham = SanPham::find($request->san_pham_id);
        $soLuongTonKho = $sanPham->khoHang->so_luong_ton_kho ?? 0; // Số lượng tồn kho hiện tại (nếu chưa có thì là 0)
        $tongSoLuong = $soLuongTonKho + $request->so_luong_nhap;
    
        // Cập nhật hoặc tạo mới bản ghi kho hàng
        $khoHang = KhoHang::updateOrCreate(
            ['san_pham_id' => $request->san_pham_id],
            [
                'so_luong_ton_kho' => $tongSoLuong,
            ]
        );
    
        return redirect()->route('kho-hang.index')->with('success', 'Sản phẩm đã được thêm vào kho.');
    }

    public function outOfStock()
    {
        // Lấy danh sách sản phẩm hết hàng
       $khoHangs = KhoHang::where('so_luong_ton_kho', 0)->get();

        // Trả về view danh sách sản phẩm hết hàng
        return view('remake.kho-hang.kho-hang-zero', compact('khoHangs'));
    }
    

    // Hiển thị form chỉnh sửa số lượng sản phẩm trong kho
    public function edit(KhoHang $khoHang)
    {
        return view('remake.kho-hang.sua-kho-hang', compact('khoHang'));
    }

    // Cập nhật thông tin sản phẩm trong kho
    public function update(Request $request, $id)
    {
        // Kiểm tra dữ liệu nhập vào
        $request->validate([
            'so_luong_nhap' => 'required|integer|min:0',
        ]);
    
        // Tìm sản phẩm trong kho và cập nhật số lượng tồn kho
        $khoHang = KhoHang::findOrFail($id);
        $khoHang->so_luong_ton_kho += $request->so_luong_nhap;
        $khoHang->save();
    
        return redirect()->route('kho-hang.index')->with('success', 'Cập nhật sản phẩm trong kho thành công!');
    }
    


    // Xóa sản phẩm khỏi kho
    public function destroy(KhoHang $khoHang)
    {
        $khoHang->delete();
        return redirect()->route('kho-hang.index')->with('success', 'Xóa sản phẩm khỏi kho thành công');
    }
}
