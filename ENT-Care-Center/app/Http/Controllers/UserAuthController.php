<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\roles;

class UserAuthController extends Controller
{
    public $data = [];
    public function index()
    {
        $this->data['title'] = "LIỆT KÊ ADMIN";
        //admin kèm theo quyền roles sắp xếp theo thứ tự và phân 5 người 1 trang.
        $admin = User::with('roles')->orderBy('id', 'ASC')->paginate(6);


        return view("Admin.auth.AllUsers", $this->data, compact('admin'));
    }

    public function phanquyen(Request $request)
    {

        //ss email với email trong csdl
        $user = User::where('email', $request['email'])->first();
        $user->roles()->detach(); // attach để  kết hợp, detach tách ra hết. đối lập nhau.
        // mình check quyền gì thì vào model roles thêm quyền đó
        if ($request['admin_role']) {
            $user->roles()->attach(roles::where('name', 'admin')->first());
        }
        if ($request['doctor_role']) {
            $user->roles()->attach(roles::where('name', 'doctor')->first());
        }
        if ($request['nv_role']) {
            $user->roles()->attach(roles::where('name', 'nhanvienquanli')->first());
        }
        return redirect()->back()->with('status', 'Thành Công');
    }
}
