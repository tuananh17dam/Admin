<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\DonHangSanPham;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ThongKeController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());
    
        $tongDoanhThu = DonHang::where('tinh_trang', 'Đã giao')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('tong_thanh_toan');
    
        $tongDaGiao = DonHang::where('tinh_trang', 'Đã giao')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
    
        $tongDaHuy = DonHang::where('tinh_trang', 'Hủy đơn')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $tongDangGiao = DonHang::where('tinh_trang', 'Chưa giao')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
    
        $tongHoanHang = DonHang::where('tinh_trang', 'Hoàn hàng')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
    
        $sanPhamBanChay = DonHangSanPham::join('san_phams', 'don_hang_san_pham.san_pham_id', '=', 'san_phams.id')
            ->select('san_phams.ten_san_pham', DB::raw('SUM(don_hang_san_pham.so_luong) as so_luong'))
            ->whereBetween('don_hang_san_pham.created_at', [$startDate, $endDate])
            ->groupBy('san_phams.ten_san_pham')
            ->orderByDesc('so_luong')
            ->get();
    
            $thongKeThang = DonHang::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(CASE WHEN tinh_trang = "Đã giao" OR tinh_trang = "Chưa giao" THEN 1 ELSE 0 END) as total')
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
    
        $months = [];
        $totals = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthData = $thongKeThang->firstWhere('month', $i);
            $months[] = Carbon::create()->month($i)->format('F');
            $totals[] = $monthData ? $monthData->total : 0;
        }
    
        return view('remake.thongke.index', compact(
            'tongDoanhThu', 'tongDaGiao', 'tongDaHuy', 'tongHoanHang', 
            'sanPhamBanChay', 'startDate', 'endDate', 'months', 'totals','tongDangGiao'
        ));
    }
    
}
