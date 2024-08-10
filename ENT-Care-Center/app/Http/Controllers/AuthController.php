<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $emailExists = admin::where('AD_Email', $request->AD_Email)->exists();
        $phoneExists = admin::where('AD_Phone', $request->AD_Phone)->exists();

        // Nếu email hoặc số điện thoại đã tồn tại, trả về lỗi
        if ($phoneExists || $emailExists) {
            return back()->with('error', 'Email hoặc số điện thoại đã tồn tại!');
        }

        // Tạo và lưu thông tin người dùng mới
        $dangky = new admin;

        $dangky->AD_Name = $request->input('AD_Name');
        $dangky->AD_Phone = $request->input('AD_Phone');
        $dangky->AD_Email = $request->input('AD_Email');
        // $dangky->AD_Password = $request->input('AD_Password');
        $dangky->AD_Password = Hash::make($request->input('AD_Password')); // Mã hóa mật khẩu

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
        // Validate the request data
        $credentials = $request->only('AD_Email', 'AD_Password');

        // Tìm người dùng theo email
        $user = admin::where('AD_Email', $credentials['AD_Email'])->first();

        // Kiểm tra xem người dùng có tồn tại và mật khẩu có khớp không
        if ($user && Hash::check($credentials['AD_Password'], $user->AD_Password)) {
            // Đăng nhập người dùng sử dụng ID
            Auth::loginUsingId($user->id); // Sử dụng $user->id từ model

            // Chuyển hướng đến trang quản lý lịch hẹn
            return redirect()->route('Admin.trangchu');
        } else {
            // Đăng nhập thất bại
            return redirect()->back()->with('error', 'Đăng nhập không thành công. Xin vui lòng đăng nhập lại !');
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
