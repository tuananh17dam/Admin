<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DonHang;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Hiển thị danh sách tài khoản
    public function index()
    {
        $users = User::all();
        return view('remake.user.users_index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('remake.user.users_detail', compact('user'));
    }

    // Thêm tài khoản mới
    public function create()
    {
        return view('remake.user.users_create');
    }

    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $validatedData = $request->validate([
            'name' => 'required|string|unique:users,name|max:255',
            'address' => 'required|string|max:500',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|max:500',
            'role'    => 'required|string|max:500',
        ]);

        // Tạo người dùng mới với dữ liệu đã validate
        User::create($validatedData);

        // Điều hướng về trang danh sách với thông báo thành công
        return redirect()->route('user.index')
            ->with('success', 'Người dùng đã được thêm thành công!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('remake.user.users_edit', compact('user'));
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, $id)
    {
        // Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $id,
            'address' => 'required|string|max:500',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'password' => 'required|string|max:500',
            'role'    => 'required|string|max:500',
        ]);

        // Tìm và cập nhật người dùng theo ID
        $user = User::findOrFail($id);
        $user->update($validatedData);

        // Điều hướng về trang danh sách với thông báo thành công
        return redirect()->route('user.index')
            ->with('success', 'Người dùng đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        // Không cho phép xóa tài khoản có ID là 1
        if ($id == 1) {
            return redirect()->route('user.index')
                ->with('success', 'Không thể xóa tài khoản quản trị mặc định.');
        }

        // Không cho phép người dùng tự xóa tài khoản của chính mình
        if (auth()->user()->id == $id) {
            return redirect()->route('user.index')
                ->with('success', 'Bạn không thể tự xóa tài khoản của mình.');
        }

        //Kiểm tra nếu người dùng có đơn hàng liên quan
        if (DonHang::where('user_id', $id)->exists()) {
            return redirect()->route('user.index')
                ->with('success', 'Không thể xóa người dùng vì có thông tin ở đơn hàng.');
        }

        // Tìm và xóa người dùng
        $user = User::findOrFail($id);
        $user->delete();

        // Điều hướng về trang danh sách với thông báo thành công
        return redirect()->route('user.index')
            ->with('success', 'Người dùng đã được xóa thành công.');
    }
}
