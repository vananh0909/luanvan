<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AuthController extends Controller
{
    public $data = [];
    public function auth()
    {
        $this->data['title'] = "ĐĂNG KÝ AUTH";
        return view('Admin.auth.register', $this->data);
    }

    public function postauth(Request $request)
    {

        // Kiểm tra xem email sdt  đã tồn tại trong cơ sở dữ liệu chưa

        $emailExists = User::where('email', $request->email)->exists();
        $phoneExists = User::where('phone', $request->phone)->exists();

        // Nếu email hoặc số điện thoại đã tồn tại, trả về lỗi
        if ($phoneExists || $emailExists) {
            return back()->with('error', 'Email hoặc số điện thoại đã tồn tại!');
        }

        // Tạo và lưu thông tin người dùng mới
        $dangky = new User;

        $dangky->name = $request->input('name');
        $dangky->phone = $request->input('phone');
        $dangky->email = $request->input('email');
        // $dangky->AD_Password = $request->input('AD_Password');
        $dangky->password = Hash::make($request->input('password')); // Mã hóa mật khẩu

        $dangky->save();

        return redirect()->back()->with('status', 'Thêm Thành Công!');
    }

    public function LoginAuth()
    {
        $this->data['title'] = "ĐĂNG NHẬP AUTH";
        return view('Admin.auth.LoginAuth', $this->data);
    }

    public function postLoginAuth(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công, chuyển hướng đến trang dashboard hoặc trang chủ
            return redirect()->route('Admin.trangchu');
        } else {
            // Đăng nhập thất bại
            return back()->with('error', 'Email hoặc mật khẩu không chính xác.');
        }
    }

    public function logoutAuth(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();



        return redirect()->route('LoginAuth');
    }
}
