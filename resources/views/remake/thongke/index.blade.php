@extends('layouts.master')

@section('title', 'Thống Kê Doanh Thu')

@section('content')
    <div class="row mb-4">
        <!-- Bộ lọc thời gian -->
        <div class="col-md-12 d-flex justify-content-end">
            <form action="{{ route('thongke.index') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                    <span class="input-group-text">đến</span>
                    <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                    <button type="submit" class="btn btn-primary">Lọc</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <!-- Tổng Doanh Thu -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5>Tổng Doanh Thu</h5>
                    <h2>{{ number_format($tongDoanhThu) }} VNĐ</h2>
                </div>
            </div>
        </div>

        <!-- Số Đơn Đã Giao -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5>Số Đơn Đã Giao</h5>
                    <h2>{{ $tongDaGiao }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
    <div class="card shadow-sm border-0">
        <div class="card-body text-center">
            <h5>Số Đơn Chưa Giao</h5>
            <h2>{{ $tongDangGiao }}</h2>
        </div>
    </div>
</div>

        <!-- Số Đơn Hủy -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5>Số Đơn Hủy</h5>
                    <h2>{{ $tongDaHuy }}</h2>
                </div>
            </div>
        </div>

        <!-- Số Đơn Hoàn Hàng -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5>Số Đơn Hoàn Hàng</h5>
                    <h2>{{ $tongHoanHang }}</h2>
                </div>
            </div>
        </div>
    </div>
<!-- 
    <div class="row mt-4">
        Biểu Đồ Tròn - Sản Phẩm Bán Chạy 
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Sản Phẩm Bán Chạy</h5>
                </div>
                <div class="card-body">
                    <canvas id="myPieChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

         Biểu Đồ Đường - Thống Kê Đơn Hàng Theo Tháng 
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Thống Kê Đơn Hàng Theo Tháng</h5>
                </div>
                <div class="card-body">
                    <canvas id="myLineChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div> -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Biểu Đồ Tròn - Sản Phẩm Bán Chạy
        //const sanPhamData = {!! json_encode($sanPhamBanChay) !!};
        const sanPhamLabels = sanPhamData.map(sanPham => sanPham.ten_san_pham);
        const sanPhamValues = sanPhamData.map(sanPham => sanPham.so_luong);

        new Chart(document.getElementById('myPieChart'), {
            type: 'pie',
            data: {
                labels: sanPhamLabels,
                datasets: [{
                    data: sanPhamValues,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Biểu Đồ Đường - Thống Kê Đơn Hàng Theo Tháng
     //   const monthLabels = {!! json_encode($months) !!};
     //   const totalOrders = {!! json_encode($totals) !!};

        new Chart(document.getElementById('myLineChart'), {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Tổng Đơn Hàng',
                    data: totalOrders,
                    borderColor: '#36A2EB',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
@endsection
