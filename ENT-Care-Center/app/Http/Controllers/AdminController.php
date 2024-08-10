<?php

namespace App\Http\Controllers;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
// băm pass
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Models\nhanvien;
use App\Models\dv_dichvu1;
use App\Models\dv_dichvu2;
use App\Models\Users;
use App\Models\lichhen;
use App\Models\admin;
use App\Models\roles;
use App\Models\lt_lichtruc;
use App\Models\lt_lichtrucbs;

class AdminController extends Controller
{


    public $data = [];
    public function index()
    {
        return view("Admin.homead");
    }

    public function trangchu()
    {
        $this->data['title'] = "TRANG CHỦ ADMIN";
        return view("Admin.trangchu", $this->data);
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
        $data = $request->all();
        // Tạo và lưu thông tin người dùng mới
        $dangky = new admin();
        $dangky->AD_Name = $data['AD_Name'];
        $dangky->AD_Phone = $data['AD_Phone'];
        $dangky->AD_Email = $data['AD_Email'];
        $dangky->AD_Password = Hash::make($data['AD_Password']); // Mã hóa mật khẩu

        $dangky->save();

        return redirect()->back()->with('status', 'Thêm Thành Công!');
    }

    public function postLoginAuth(Request $request)
    {
        // Lấy dữ liệu từ request
        $email = $request->input('AD_Email');
        $password = $request->input('AD_Password');

        // Sử dụng Auth::attempt() với khóa 'password'
        if (Auth::attempt(['AD_Email' => $email, 'AD_Password' => $password])) {
            // Đăng nhập thành công, chuyển hướng đến trang dashboard hoặc trang chủ
            return redirect()->route('Admin.trangchu')->with('status', 'Đăng nhập thành công!');
        } else {
            // Đăng nhập thất bại
            return back()->with('error', 'Email hoặc mật khẩu không chính xác.');
        }




        // if (Auth::attempt(['AD_Email' => $email, 'AD_Password' => $password])) {
        //     echo (Auth::attempt(['AD_Email' => $email, 'AD_Password' => $password]));
        // } else {
        //     return ' sai';
        // }






        // Validate the request data
        //     $credentials = $request->only('AD_Email', 'AD_Password');

        //     // Tìm người dùng theo email
        //     $user = Admin::where('AD_Email', $credentials['AD_Email'])->first();

        //     // Kiểm tra xem người dùng có tồn tại và mật khẩu có khớp không
        //     if ($user && Hash::check($credentials['AD_Password'], $user->AD_Password)) {
        //         // Đăng nhập người dùng sử dụng ID
        //         Auth::loginUsingId($user->id); // Sử dụng $user->id từ model

        //         // Chuyển hướng đến trang quản lý lịch hẹn
        //         return redirect()->route('Admin.trangchu');
        //     } else {
        //         // Đăng nhập thất bại
        //         return redirect()->back()->with('error', 'Đăng nhập không thành công. Xin vui lòng đăng nhập lại !');
        //     }
    }



    // public function postdangky(Request $request)
    // {
    //     $dangky = new admin;

    //     $dangky->AD_Name = $request->input('AD_Name');
    //     $dangky->AD_Phone = $request->input('AD_Phone');
    //     $dangky->AD_Email = $request->input('AD_Email');
    //     $dangky->AD_Password = Hash::make($request->input('AD_Password'));

    //     $dangky->save();
    //     // session(['admin' => $this->dangky->id]);
    //     // Lưu chỉ id của admin vào session
    //     $save = $dangky->id;
    //     // session(['admin' => $dangky->id]);
    //     session(['admin' => $save]);


    //     return redirect()->back()->with('status', 'Thêm Thành Công!');
    // }

    // public function dangnhapad()
    // {
    //     $this->data['title'] = "TRANG ĐĂNG NHẬP QUẢN TRỊ";


    //     return view("Admin.layoutsAd.bodyAd", $this->data);
    // }







    // public function login(Request $request)
    // {
    //     // Kiểm tra xem email sdt  đã tồn tại trong cơ sở dữ liệu chưa
    //     $request->validate([
    //         'AD_Email' => 'required|email',
    //         'AD_Password' => 'required',
    //     ]);

    //     // Attempt to authenticate the user
    //     $credentials = $request->only('AD_Email', 'AD_Password');
    //     if (Auth::attempt($credentials)) {
    //         // Authentication passed
    //         return redirect()->route('alluser')->with('status', 'Đăng nhập thành công.');
    //     } else {
    //         // Authentication failed
    //         return redirect()->back()->with('error', 'Đăng nhập không thành công. Xin vui lòng kiểm tra lại thông tin.');
    //     }
    // }


    public function quanlylichhen()
    {
        $this->data['title'] = "DANH SÁCH LỊCH HẸN";

        // Thực hiện truy vấn để lấy ra thông tin của những người có lịch hẹn
        $Lichhen = DB::select('
        SELECT customer.*, lichhen.LH_BSkham, lichhen.LH_Id, lichhen.LH_Email, lichhen.LH_Ngaykham, lichhen.LH_Giokham, lichhen.LH_trieuchung
        FROM customer
        INNER JOIN lichhen ON customer.CUS_Id = lichhen.LH_CustomerID
        ORDER BY  LH_Ngaykham ASC


    ');

        // Trả về view để hiển thị thông tin lịch hẹn
        return view("Admin.layoutsAd.qllichhen", $this->data, compact('Lichhen'));
    }





    public function quanlybacsy()
    {
        $this->data['title'] = "QUẢN LÝ BÁC SỸ";
        $bacsi = DB::table('nhanvien')->where('NV_Chucvu', 'Bác sĩ')->get();
        $lichtruc = lt_lichtruc::orderBy('Created_at', 'DESC')->get();


        $lichtruc = lt_lichtrucbs::all();

        return view("Admin.layoutsAd.qlbacsi", $this->data, compact('bacsi', 'lichtruc'));
    }

    public function postlichtruc(Request $request)
    {

        $Tenbs = $request->input('lt_tenbacsi');
        $ngaytruc = $request->input('lt_Ngaytruc');
        $giotruc = $request->input('lt_Giotruc'); // Đây sẽ là một mảng chứa các giờ đã chọn

        // Kiểm tra xem có giờ nào được chọn không
        if (!is_array($giotruc) || empty($giotruc)) {
            return redirect()->back()->with('error', 'Bạn phải chọn ít nhất một giờ.');
        }

        // Lặp qua từng giờ đã chọn và lưu vào cơ sở dữ liệu
        foreach ($giotruc as $time) {
            lt_lichtruc::create([
                'lt_tenbacsi' => $Tenbs,
                'lt_Ngaytruc' => $ngaytruc,
                'lt_Giotruc' => $time,
                // Thêm các trường khác nếu cần, ví dụ: 'bacsi_id' nếu có
            ]);
        }

        return redirect()->back()->with('status', 'Lịch trực đã được phân thành công!');
    }

    public function sualichtruc($id)
    {
        $this->data['title'] = "SỬA LỊCH TRỰC";
        $bacsi = DB::table('nhanvien')->where('NV_Chucvu', 'Bác sĩ')->get();
        $lichtruc = lt_lichtruc::where('lt_Id', $id)->first();

        $Lichtruc = lt_lichtruc::all();

        return view("Admin.layoutsAd.lichtruc.sualichtruc", $this->data, compact('bacsi', 'Lichtruc', 'lichtruc'));
    }

    public function editlichtruc(Request $request, $id)
    {
        $lichtruc = lt_lichtruc::where('lt_Id', $id)->first(); // Tìm lịch trực với $id

        // Cập nhật thông tin từ request
        $lichtruc->lt_tenbacsi = $request->input('lt_tenbacsi');
        $lichtruc->lt_Ngaytruc = $request->input('lt_Ngaytruc');

        // Lưu thay đổi vào cơ sở dữ liệu
        $lichtruc->save();

        // Redirect về trang trước với thông báo
        return redirect()->back()->with('status', 'Cập Nhật Thành Công!');
    }



    public function xoalichtruc($id)
    {


        $lt = lt_lichtruc::where('lt_Id', $id)->first();



        $lt->delete();




        return redirect()->back()->with('status', 'Xóa thành công  !');
    }



    public function quanlybenhnhan()
    {
        $this->data['title'] = "QUẢN LÝ BỆNH NHÂN";
        $khachhang = Users::all();

        return view("Admin.layoutsAd.qlbenhnhan", $this->data, compact('khachhang'));
    }

    public function suathongtin($id)
    {
        $this->data['title'] = "SỬA THÔNG TIN";

        $kh = Users::where('CUS_Id', $id)->first();
        return view("Admin.layoutsAd.khachhang.suathongtin", $this->data, compact('kh'));
    }

    public function editthongtin(Request $request, $id)
    {
        $this->data['title'] = "SỬA THÔNG TIN";

        $kh = Users::where('CUS_Id', $id)->first();

        if ($request->hasFile('CUS_Avatar')) {
            //neu cos file dinh kem trong form update thi thim file cu va xoa, khong thi thoi
            $avtcu = 'uploads/avtkhachhang/' . $kh->CUS_Avatar;
            if (File::exists($avtcu)) {
                File::delete($avtcu);
            }
            $file = $request->file('CUS_Avatar');
            $extension = $file->getClientOriginalExtension(); //lay ten mo rong duoi jpg, png,..
            $filename = time() . '.' . $extension;
            $file->move('uploads/avtkhachhang/', $filename); //upload lên thư mục
            $kh->CUS_Avatar = $filename;
        }
        $kh->CUS_Name = $request->input('CUS_Name');
        $kh->CUS_Birthday = $request->input('CUS_Birthday');
        $kh->CUS_Gender = $request->input('CUS_Gender');
        $kh->CUS_Address = $request->input('CUS_Address');
        $kh->CUS_Email = $request->input('CUS_Email');
        $kh->CUS_Phone = $request->input('CUS_Phone');
        $kh->CUS_Nganhang = $request->input('CUS_Nganhang');
        $kh->CUS_Stk = $request->input('CUS_Stk');

        $kh->update();

        return redirect()->back()->with('status', 'Cập nhật thành công !');
    }


    public function xoabenhnhan($id)
    {


        $kh = Users::where('CUS_Id', $id)->first();



        $kh->delete();




        return redirect()->back()->with('status', 'Xóa thành công  !');
    }

    public function quanlydichvu()
    {
        $this->data['title'] = "QUẢN LÝ DỊCH VỤ";

        $Dichvu1 = dv_dichvu1::all();
        $Dichvu2 = dv_dichvu2::all();
        return view("Admin.layoutsAd.qldichvu", $this->data, compact('Dichvu1', 'Dichvu2'));
    }

    public function themdichvu()
    {
        $this->data['title'] = "THÊM DỊCH VỤ";


        return view("Admin.layoutsAd.dichvu.dichvu1", $this->data);
    }

    public function postdichvu1(Request $request)
    {
        $dichvu1 = new dv_dichvu1;

        $dichvu1->DV_Tendv = $request->input('DV_Tendv');
        $dichvu1->DV_Gia = $request->input('DV_Gia');


        $dichvu1->save();
        return redirect()->back()->with('status', 'Thêm Dịch Vụ Thành Công!');
    }


    public function suadichvu($id)
    {
        $this->data['title'] = "SỬA GÓI DỊCH VỤ";
        $dichvu1 = dv_dichvu1::where('DV_ID', $id)->first();



        return view("Admin.layoutsAd.dichvu.suadichvu", $this->data, compact('dichvu1'));
    }

    public function editdichvu(Request $request, $id)
    {

        $dichvu1 = dv_dichvu1::where('DV_ID', $id)->first();

        $dichvu1->DV_Tendv = $request->input('DV_Tendv');

        $dichvu1->DV_Gia = $request->input('DV_Gia');
        $dichvu1->update();
        return redirect()->back()->with('status', 'Cập Nhật Thành Công!');
    }

    public function xoadichvu($id)
    {

        $dv1 = dv_dichvu1::where('DV_ID', $id)->first();
        $dv1->delete();


        return redirect()->back()->with('status', 'Xóa thành công  !');
    }



    public function postdichvu2(Request $request)
    {
        $dichvu2 = new dv_dichvu2;

        $dichvu2->DV2_Tendv = $request->input('DV2_Tendv');
        if ($request->hasFile('DV2_anhdv')) {
            $file = $request->file('DV2_anhdv');
            $extension = $file->getClientOriginalExtension(); //lay ten mo rong duoi jpg, png,..
            $filename = time() . '.' . $extension;
            $file->move('uploads/dichvu/', $filename); //upload lên thư mục
            $dichvu2->DV2_anhdv = $filename;
        }
        $dichvu2->DV2_gioithieu = $request->input('DV2_gioithieu');


        $dichvu2->save();
        return redirect()->back()->with('status', 'Thêm Dịch Vụ Thành Công!');
    }
    public function themgoidichvu()
    {
        $this->data['title'] = "THÊM GÓI DỊCH VỤ";


        return view("Admin.layoutsAd.dichvu.dichvu2", $this->data);
    }

    public function suagoidichvu($id)
    {
        $this->data['title'] = "SỬA GÓI DỊCH VỤ";
        $dichvu2 = dv_dichvu2::where('DV2_ID', $id)->first();

        return view("Admin.layoutsAd.dichvu.suagoidichvu", $this->data, compact('dichvu2'));
    }


    public function editgoidichvu(Request $request, $id)
    {

        $dichvu2 = dv_dichvu2::where('DV2_ID', $id)->first();
        $dichvu2->DV2_Tendv = $request->input('DV2_Tendv');
        if ($request->hasFile('DV2_anhdv')) {
            //neu cos file dinh kem trong form update thi thim file cu va xoa, khong thi thoi
            $avtcu = 'uploads/dichvu/' . $dichvu2->DV2_anhdv;
            if (File::exists($avtcu)) {
                File::delete($avtcu);
            }
            $file = $request->file('DV2_anhdv');
            $extension = $file->getClientOriginalExtension(); //lay ten mo rong duoi jpg, png,..
            $filename = time() . '.' . $extension;
            $file->move('uploads/dichvu/', $filename); //upload lên thư mục
            $dichvu2->DV2_anhdv = $filename;
        }
        $dichvu2->DV2_gioithieu = $request->input('DV2_gioithieu');
        $dichvu2->update();
        return redirect()->back()->with('status', 'Cập Nhật Thành Công!');
    }

    public function xoagoidichvu($id)
    {

        $dv2 = dv_dichvu2::where('DV2_ID', $id)->first();


        $avt = 'uploads/dichvu/' . $dv2->DV2_anhdv;
        if (File::exists($avt)) {
            File::delete($avt);
        }
        $dv2->delete();




        return redirect()->back()->with('status', 'Xóa thành công  !');
    }

    public function quanlynhanvien()
    {
        $this->data['title'] = "QUẢN LÝ NHÂN VIÊN";

        $Nhanvien = nhanvien::all();
        return view("Admin.layoutsAd.qlinhanvien", $this->data, compact('Nhanvien'));
    }

    public function themnhanvien()
    {
        $this->data['title'] = "THÊM NHÂN VIÊN";

        $chucvu = roles::all();

        return view("Admin.layoutsAd.nhanvien.addnv", $this->data, compact('chucvu'));
    }

    public function postnhanvien(Request $request)
    {
        $Nhanvien = new nhanvien;
        if ($request->hasFile('NV_Avatar')) {
            $file = $request->file('NV_Avatar');
            $extension = $file->getClientOriginalExtension(); //lay ten mo rong duoi jpg, png,..
            $filename = time() . '.' . $extension;
            $file->move('uploads/avtnhanvien/', $filename); //upload lên thư mục
            $Nhanvien->NV_Avatar = $filename;
        }
        $Nhanvien->NV_Ten = $request->input('NV_Ten');
        $Nhanvien->NV_Birthday = $request->input('NV_Birthday');
        $Nhanvien->NV_Gioitinh = $request->input('NV_Gioitinh');
        $Nhanvien->NV_Diachi = $request->input('NV_Diachi');
        $Nhanvien->NV_Email = $request->input('NV_Email');
        $Nhanvien->NV_Sdt = $request->input('NV_Sdt');
        $Nhanvien->NV_Trinhdo = $request->input('NV_Trinhdo');
        $Nhanvien->NV_Chucvu = $request->input('NV_Chucvu');
        $Nhanvien->NV_Gioithieu = $request->input('NV_Gioithieu');

        $Nhanvien->save();
        return redirect()->back()->with('status', 'Thêm Nhân Viên Thành Công !');
    }

    public function suanhanvien($id)
    {
        $this->data['title'] = "SỬA NHÂN VIÊN";
        $chucvu = roles::all();
        $Nhanvien = nhanvien::where('NV_Id', $id)->first();



        return view("Admin.layoutsAd.nhanvien.editnv", $this->data, compact('Nhanvien', 'chucvu'));
    }

    public function editnhanvien(Request $request, $id)
    {
        $this->data['title'] = "SỬA NHÂN VIÊN";

        $Nhanvien = nhanvien::where('NV_Id', $id)->first();


        if ($request->hasFile('NV_Avatar')) {
            //neu cos file dinh kem trong form update thi thim file cu va xoa, khong thi thoi
            $avtcu = 'uploads/avtnhanvien/' . $Nhanvien->NV_Avatar;
            if (File::exists($avtcu)) {
                File::delete($avtcu);
            }
            $file = $request->file('NV_Avatar');
            $extension = $file->getClientOriginalExtension(); //lay ten mo rong duoi jpg, png,..
            $filename = time() . '.' . $extension;
            $file->move('uploads/avtnhanvien/', $filename); //upload lên thư mục
            $Nhanvien->NV_Avatar = $filename;
        }
        $Nhanvien->NV_Ten = $request->input('NV_Ten');
        $Nhanvien->NV_Birthday = $request->input('NV_Birthday');
        $Nhanvien->NV_Gioitinh = $request->input('NV_Gioitinh');
        $Nhanvien->NV_Diachi = $request->input('NV_Diachi');
        $Nhanvien->NV_Email = $request->input('NV_Email');
        $Nhanvien->NV_Sdt = $request->input('NV_Sdt');
        $Nhanvien->NV_Trinhdo = $request->input('NV_Trinhdo');
        $Nhanvien->NV_Chucvu = $request->input('NV_Chucvu');
        $Nhanvien->NV_Gioithieu = $request->input('NV_Gioithieu');
        $Nhanvien->update();

        return redirect()->back()->with('status', 'Cập nhật thành công !');
    }

    public function xoanhanvien($id)
    {
        $Nv = nhanvien::where('NV_Id', $id)->first();

        $avt = 'uploads/avtnhanvien/' . $Nv->NV_Avatar;
        if (File::exists($avt)) {
            File::delete($avt);
        }
        $Nv->delete();
        return redirect()->back()->with('status', 'Xóa thành công  !');
    }



    public function thongkebaocao()
    {

        $this->data['title'] = "THỐNG KÊ SỐ LƯỢNG BỆNH NHÂN";
        return view("Admin.layoutsAd.thongkebaocao", $this->data);
    }



    // Lịch trực bác sĩ

    public function doctor()
    {

        $this->data['title'] = "BÁC SĨ";

        return view("Admin.doctors.doctor", $this->data);
    }

    public function postdoctor(Request $request)
    { {
            $ngaytruc = $request->input('lt_ngaytruc');
            $giotruc = $request->input('lt_giotruc'); // Đây sẽ là một mảng chứa các giờ đã chọn

            // Kiểm tra xem có giờ nào được chọn không
            if (!is_array($giotruc) || empty($giotruc)) {
                return redirect()->back()->with('error', 'Bạn phải chọn ít nhất một giờ.');
            }

            // Lặp qua từng giờ đã chọn và lưu vào cơ sở dữ liệu
            foreach ($giotruc as $time) {
                lt_lichtrucbs::create([
                    'lt_ngaytruc' => $ngaytruc,
                    'lt_giotruc' => $time,
                    // Thêm các trường khác nếu cần, ví dụ: 'bacsi_id' nếu có
                ]);
            }

            return redirect()->back()->with('status', 'Lịch trực đã được đăng ký thành công!');
        }
    }

    public function xemlichtruc()
    {

        $this->data['title'] = "LỊCH TRỰC";
        $xemlichtruc = lt_lichtrucbs::all();

        return view("Admin.doctors.xemlichtruc", $this->data, compact('xemlichtruc'));
    }

    public function sualichtrucbs()
    {

        $this->data['title'] = "LỊCH TRỰC";
        $xemlichtruc = lt_lichtrucbs::all();

        return view("Admin.doctors.xemlichtruc", $this->data, compact('xemlichtruc'));
    }

    public function postsualichtruc() {}

    public function xoalichtrucbs() {}
}