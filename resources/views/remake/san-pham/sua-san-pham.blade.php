@extends('layouts.master')

@section('title', 'Sửa sản phẩm')

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Sản phẩm @endslot
        @slot('title') Sửa sản phẩm @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Form sửa sản phẩm -->
                    <form action="{{ route('san-pham.update', $sanPham->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Thêm phương thức PUT để cập nhật -->
                        
                        <div class="mb-3">
                            <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="ten_san_pham" name="ten_san_pham" value="{{ $sanPham->ten_san_pham }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="gia_nhap" class="form-label">Giá nhập</label>
                            <input type="text" class="form-control" id="gia_nhap" name="gia_nhap" value="{{ $sanPham->gia_nhap }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="gia_ban" class="form-label">Giá bán</label>
                            <input type="text" class="form-control" id="gia_ban" name="gia_ban" value="{{ $sanPham->gia_ban }}" required>
                        </div>                        
                        <div class="mb-3">
                            <label for="hinh_anh" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="hinh_anh" name="hinh_anh" accept="image/*">
                            <small class="form-text text-muted">Để trống nếu không muốn thay đổi hình ảnh.</small>
                        </div>

                        <!-- Nút sửa và nút hủy -->
                        <button type="submit" class="btn btn-success">Sửa</button>
                        <a href="{{ route('san-pham.index') }}" class="btn btn-secondary">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
