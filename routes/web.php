<?php

use App\Http\Controllers\SanPhamController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KhachHangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');



Route::get('/danh-sach-san-pham', [SanPhamController::class, 'index'])->name('san-pham.index');
Route::post('san-pham', [SanPhamController::class, 'store'])->name('san-pham.store');

Route::get('san-pham/{id}/edit', [SanPhamController::class, 'edit'])->name('san-pham.edit');
Route::put('san-pham/{id}', [SanPhamController::class, 'update'])->name('san-pham.update');


Route::get('them-san-pham', [SanPhamController::class, 'create'])->name('them-san-pham');

// Route để xử lý lưu sản phẩm mới (POST)


Route::post('them-san-pham', [SanPhamController::class, 'store'])->name('them-san-pham.post');



Route::get('danh-sach-khach-hang', [KhachHangController::class, 'index'])->name('khach-hang.index');

Route::get('them-khach-hang', [KhachHangController::class, 'create'])->name('them-khach-hang');

// Route để xử lý lưu khách hàng mới (POST)
Route::post('them-khach-hang', [KhachHangController::class, 'store'])->name('them-khach-hang.post');


Route::delete('khach-hang/{id}', [KhachHangController::class, 'destroy'])->name('khach-hang.destroy');


Route::resource('san-pham', SanPhamController::class);
//Route::resource('khach-hang', KhachHangController::class);



// Route để hiển thị form sửa khách hàng
Route::get('sua-khach-hang/{id}', [KhachHangController::class, 'edit'])->name('khach_hang.edit');

// Route để xử lý cập nhật khách hàng
Route::post('sua-khach-hang/{id}', [KhachHangController::class, 'update'])->name('khach_hang.update');


Route::delete('san-pham/mass-destroy', [SanPhamController::class, 'massDestroy'])->name('san-pham.massDestroy');


// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);



//Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
