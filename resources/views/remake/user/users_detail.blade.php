@extends('layouts.master')

@section('css')
<link href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<style>
    /* Styling adjustments for card and table */
    .sales-account-detail-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .sales-account-detail-card {
        width: 100%;
        max-width: 800px;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        background-color: #007bff; /* Blue background */
        color: white; /* White text */
    }

    .account-info table {
        width: 100%;
    }

    .account-info th, .account-info td {
        padding: 10px;
        border-bottom: 1px solid #dee2e6;
    }

    .account-info th {
        background-color: #0056b3; /* Darker blue for header cells */
        color: white;
        font-weight: bold;
    }

    .account-info td {
        color: #f8f9fa; /* Slightly lighter white for text */
    }

    .btn-back {
        display: inline-block;
        margin-top: 15px;
        background-color: #f8f9fa;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        color: #007bff; /* Blue text */
        transition: background-color 0.3s;
        text-align: center;
    }

    .btn-back:hover {
        background-color: #e2e6ea; /* Light gray on hover */
    }

    /* Adjust font sizes and padding for mobile screens */
    @media (max-width: 576px) {
        .sales-account-detail-card {
            padding: 20px;
        }

        .account-info th, .account-info td {
            font-size: 0.9em;
            padding: 8px;
        }

        .btn-back {
            padding: 8px 10px;
            font-size: 0.9em;
        }
    }
</style>
@endsection

@section('content')
@component('components.breadcrumb')
    @slot('li_1') Tài khoản bán hàng @endslot
    @slot('title') Chi tiết tài khoản bán hàng @endslot
@endcomponent

<div class="container sales-account-detail-container" style="background-color: #99FFFF;">
    <div class="card sales-account-detail-card">
        <div class="card-body">
            <div class="account-info">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Mã tài khoản:</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th>Tên tài khoản:</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Số điện thoại:</th>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Địa chỉ:</th>
                            <td>{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <th>Vai trò:</th>
                            <td>{{ $user->role }}</td>
                        </tr>
                        <tr>
                            <th>Password:</th>
                            <td><em>Đã ẩn</em></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <a href="{{ route('user.index') }}" class="btn btn-secondary btn-back">
                <i class="bx bx-arrow-back"></i> Trở về
            </a>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
@endsection
