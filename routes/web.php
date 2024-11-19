<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    DonHangController,
    SanPhamController,
    KhachHangController,
    KhoHangController,
    UserController,
    ThongKeController,
    HomeController,
    DonHangSellerController
};
use App\Http\Controllers\Auth\LoginController;

// Authentication Routes
Auth::routes();

// Trang chủ

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Route xử lý đăng nhập
Route::post('/', [LoginController::class, 'login'])->name('login.submit');

// Route xử lý đăng xuất
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Cập nhật hồ sơ và mật khẩu
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('/update-profile/{id}', [HomeController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/update-password/{id}', [HomeController::class, 'updatePassword'])->name('updatePassword');
});
Route::prefix('san-pham')->middleware(['auth'])->name('san-pham.')->group(function () {
    Route::get('/', [SanPhamController::class, 'index'])->name('index');
    Route::get('/create', [SanPhamController::class, 'create'])->name('create');
    Route::post('/', [SanPhamController::class, 'store'])->name('store');
    Route::get('/{id}', [SanPhamController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [SanPhamController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SanPhamController::class, 'update'])->name('update');
    Route::delete('/{id}', [SanPhamController::class, 'destroy'])->name('destroy');
});

// Routes cho Khách Hàng
Route::prefix('khach-hang')->middleware(['auth'])->name('khach-hang.')->group(function () {
    Route::get('/', [KhachHangController::class, 'index'])->name('index');
    Route::get('/create', [KhachHangController::class, 'create'])->name('create');
    Route::post('/', [KhachHangController::class, 'store'])->name('store');
    Route::get('/{id}', [KhachHangController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [KhachHangController::class, 'edit'])->name('edit');
    Route::post('/{id}', [KhachHangController::class, 'update'])->name('update');
    Route::delete('/{id}', [KhachHangController::class, 'destroy'])->name('destroy');
});

// Routes cho Đơn Hàng
Route::prefix('don-hang')->middleware(['auth', 'role:admin'])->name('don-hang.')->group(function () {
    Route::get('/', [DonHangController::class, 'index'])->name('index');
    Route::get('/create', [DonHangController::class, 'create'])->name('create');
    Route::post('/', [DonHangController::class, 'store'])->name('store');
    Route::get('/{id}', [DonHangController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [DonHangController::class, 'edit'])->name('edit');
    Route::put('/{id}', [DonHangController::class, 'update'])->name('update');
    Route::delete('/{id}', [DonHangController::class, 'destroy'])->name('destroy');
});

// Routes cho Kho Hàng
Route::prefix('kho-hang')->middleware(['auth'])->name('kho-hang.')->group(function () {
    Route::get('/', [KhoHangController::class, 'index'])->name('index');
    Route::get('/create', [KhoHangController::class, 'create'])->middleware('role:admin')->name('create');
    Route::post('/', [KhoHangController::class, 'store'])->middleware('role:admin')->name('store');
    Route::get('/{id}/edit', [KhoHangController::class, 'edit'])->middleware('role:admin')->name('edit');
    Route::put('/{id}', [KhoHangController::class, 'update'])->middleware('role:admin')->name('update');
    Route::delete('/{id}', [KhoHangController::class, 'destroy'])->middleware('role:admin')->name('destroy');
    Route::get('/het-hang', [KhoHangController::class, 'outOfStock'])->name('out-of-stock');
});

// Routes cho User
Route::resource('user', UserController::class)->middleware(['auth', 'role:admin']);

Route::resource('donhang-seller', DonHangSellerController::class)->middleware(['auth', 'role:seller']);


// Route cho Thống Kê
Route::get('/thong-ke', [ThongKeController::class, 'index'])->name('thongke.index');

// Trang index
Route::get('/index', function () {
    return view('index');
})->middleware(['auth'])->name('home.index');

