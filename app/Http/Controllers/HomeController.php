<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Tạo một danh sách các thư mục cần kiểm tra
        $folders = ['remake/don-hang', 'remake/hoa-don', 'remake/khach-hang', 'remake/nguoi-dung', 'remake/san-pham'];
        // Kiểm tra trong các thư mục đã chỉ định
        foreach ($folders as $folder) {
            $viewPath = $folder . '.' . $request->path();
            if (view()->exists($viewPath)) {
                return view($viewPath);
            }
        }
        // Kiểm tra view trong thư mục gốc "resources/views"
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        // Nếu không tìm thấy view, trả về lỗi 404
        return abort(404);
    }
    

    public function root()
    {
        return view('index');
    }
    
    public function DanhSachDonHang() {
        return view('remake.don-hang.danh-sach-don-hang');
    }
    public function ChiTietDonHang() {
        return view('remake.don-hang.chi-tiet-don-hang');
    }
    // public function KhachHang() {
    //     return view('remake.khach-hang.');
    // }
    public function ChiTietSanPham() {
        return view('remake.san-pham.chi-tiet-san-pham');
    }
    public function DanhSacSanPham() {
        return view('remake.san-pham.danh-sach-san-pham');
    }
    // public function ChiTietHoaDon() {
    //     return view('remake.hoa-don.chi-tiet-hoa-don');
    // }
    // public function DanhSachHoaDon() {
    //     return view('remake.hoa-don.danh-sach-hoa-don');
    // }
    // public function ChiTietHoaDon() {
    //     return view('remake.hoa-don.chi-tiet-hoa-don');
    // }
    // public function DanhSachHoaDon() {
    //     return view('remake.hoa-don.danh-sach-hoa-don');
    // }
    // public function ChiTietHoaDon() {
    //     return view('remake.hoa-don.chi-tiet-hoa-don');
    // }

    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }
    public function updateProfile(Request $request, $id)
    {

        // return $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
            $user->avatar = '/images/' . $avatarName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            return response()->json([
                'isSuccess' => true,
                'Message' => "User Details Updated successfully!"
            ], 200); // Status code here
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message' => "Something went wrong!"
            ], 200); // Status code here
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Your Current password does not matches with the password you provided. Please try again."
            ], 200); // Status code 
        } else {
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Password updated successfully!"
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Something went wrong!"
                ], 200); // Status code here
            }
        }
    }
}
