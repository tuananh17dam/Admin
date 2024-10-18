<?php

namespace App\Http\Controllers;

use App\Models\DonHangSanPham;
use App\Models\DonHang;
use App\Models\SanPham; 
use Illuminate\Http\Request;

class DonHangSanPhamController extends Controller
{
    public function index()
    {
        $donHangSanPhams = DonHangSanPham::all();
        return response()->json($donHangSanPhams);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'don_hang_id' => 'required|exists:don_hangs,id',
            'san_pham_id' => 'required|exists:san_phams,id',
            'so_luong' => 'required|integer|min:1',
        ]);

        $donHangSanPham = DonHangSanPham::create($validatedData);
        return response()->json($donHangSanPham, 201);
    }

    public function show($id)
    {
        $donHangSanPham = DonHangSanPham::findOrFail($id);
        return response()->json($donHangSanPham);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'so_luong' => 'sometimes|required|integer|min:1',
        ]);

        $donHangSanPham = DonHangSanPham::findOrFail($id);
        $donHangSanPham->update($validatedData);
        return response()->json($donHangSanPham);
    }

    public function destroy($id)
    {
        $donHangSanPham = DonHangSanPham::findOrFail($id);
        $donHangSanPham->delete();
        return response()->json(null, 204);
    }
    
}
