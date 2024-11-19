@extends('layouts.master')

@section('title', 'Sửa Tài Khoản')

@section('content')
@component('components.breadcrumb')
@slot('li_1') Tài Khoản @endslot
@slot('title') Sửa Tài Khoản @endslot
@endcomponent

<div class="row justify-content-center">
    <div class="col-lg-10"> <!-- Tăng kích thước cột lên col-lg-10 -->
        <div class="card shadow-sm border-0" style="background-color: #e3f2fd;"> <!-- Nền xanh nhạt -->
            <div class="card-header text-white" style="background-color: #b3e5fc;">
                <h4 class="mb-0 text-center">Chỉnh sửa tài khoản bán hàng</h4> <!-- Canh giữa tiêu đề -->
            </div>
            <div class="card-body">
                <!-- Form sửa tài khoản -->
                <form action="{{ route('user.update', $user->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Tên Tài Khoản</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $user->name }}" required>
                                <div class="invalid-feedback">
                                    Vui lòng nhập tên tài khoản.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="form-label fw-bold">Địa Chỉ</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ $user->address }}" required>
                                <div class="invalid-feedback">
                                    Vui lòng nhập địa chỉ.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label fw-bold">Số Điện Thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ $user->phone }}" required>
                                <div class="invalid-feedback">
                                    Vui lòng nhập số điện thoại.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}" required>
                                <div class="invalid-feedback">
                                    Vui lòng nhập email hợp lệ.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="role" class="form-label fw-bold">Vai trò</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>admin</option>
                                    <option value="seller" {{ $user->role == 'seller' ? 'selected' : '' }}>seller</option>
                                </select>
                                <div class="invalid-feedback">
                                    Vui lòng chọn vai trò cho tài khoản.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3 position-relative">
                                <label for="password" class="form-label fw-bold">Mật Khẩu</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                        value="{{ $user->password }}" required>
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="togglePasswordVisibility()">
                                        Hiển thị
                                    </button>
                                </div>
                                <div class="invalid-feedback">
                                    Vui lòng nhập mật khẩu.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-2">
                            <i class="fas fa-save"></i> Lưu
                        </button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Hủy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const button = event.currentTarget;
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            button.textContent = 'Ẩn';
        } else {
            passwordInput.type = 'password';
            button.textContent = 'Hiển thị';
        }
    }

    // Bootstrap validation
    (function() {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
@endsection