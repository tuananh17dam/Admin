@extends('layouts.master')
@section('title') Thêm sản phẩm @endsection

@section('css')
    <!-- Add any necessary CSS here -->
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Sản phẩm @endslot
        @slot('title') Thêm sản phẩm @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <!-- Thông báo lỗi -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Thông báo thành công -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('san-pham.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="ten_san_pham" name="ten_san_pham" required>
                        </div>
                        <div class="mb-3">
                            <label for="gia_nhap" class="form-label">Giá nhập</label>
                            <input type="text" class="form-control" id="gia_nhap" name="gia_nhap" required>
                        </div>
                        <div class="mb-3">
                            <label for="gia_ban" class="form-label">Giá bán</label>
                            <input type="text" class="form-control" id="gia_ban" name="gia_ban" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="hinh_anh" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="hinh_anh" name="hinh_anh" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                        <a href="{{ route('san-pham.index') }}" class="btn btn-secondary">Hủy</a>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

@endsection

@section('script')
    <!-- Add any necessary JS here -->
@endsection
