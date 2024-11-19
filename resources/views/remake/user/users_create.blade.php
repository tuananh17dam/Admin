@extends('layouts.master')
@section('title') Thêm tài khoản @endsection

@section('css')
    <!-- Add any necessary CSS here -->
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Tài khoản bán hàng @endslot
        @slot('title') Thêm tài khoản @endslot
    @endcomponent


<form action="{{ route('user.store') }}" method="POST" class="container">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Tên Tài Khoản</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Địa Chỉ</label>
        <input type="text" class="form-control" id="address" name="address" required>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Số điện thoại</label>
        <input type="text" class="form-control" id="phone" name="phone" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Vai trò</label>
        <select class="form-control" id="role" name="role" required>
            <option value="admin">admin</option>
            <option value="seller">seller</option>
        </select>
    </div>

    <div class="mb-3 position-relative">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
            <input type="password" class="form-control" id="password" name="password" required>
            <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility()">
                Hiển thị
            </button>
        </div>
    </div>

    <div class="text-start">
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success btn-sm">Thêm Tài Khoản</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm">Hủy</a>
        </div>
    </div>
</form>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById("password");
        const button = event.target;

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            button.textContent = "Ẩn";
        } else {
            passwordInput.type = "password";
            button.textContent = "Hiển thị";
        }
    }
</script>
@endsection