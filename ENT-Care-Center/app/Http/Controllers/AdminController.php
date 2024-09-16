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
use App\Models\roles;
use App\Models\User;
use App\Models\lt_lichtruc;
use App\Models\lt_lichtrucbs;
use App\Models\KhoThuoc;

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






    public function quanlylichhen()
    {
        $this->data['title'] = "DANH SÁCH LỊCH HẸN";

        // Thực hiện truy vấn để lấy ra thông tin của những người có lịch hẹn
        $Lichhen = DB::select('
        SELECT customer.*, lichhen.LH_BSkham, lichhen.LH_Id, lichhen.LH_Email, lichhen.LH_Ngaykham, lichhen.LH_Giokham, lichhen.LH_trieuchung
        FROM customer
        INNER JOIN lichhen ON customer.CUS_Id = lichhen.LH_CustomerID
        ORDER BY  LH_Ngaykham ASC');


        return view("Admin.layoutsAd.qllichhen", $this->data, compact('Lichhen'));
    }





    public function quanlybacsy()
    {
        $this->data['title'] = "QUẢN LÝ BÁC SỸ";
        $doctors = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();


        $Lichtrucbs = DB::table('lt_lichtrucbs')
            ->select('lt_Idlt', 'lt_tenbacsi', 'lt_ngaytruc', 'lt_giotruc')
            ->get();


        return view("Admin.layoutsAd.qlbacsi", $this->data, compact('doctors', 'Lichtrucbs',));
    }

    public function postlichtruc(Request $request)
    {

        $Tenbs = $request->input('lt_tenbs');
        $ngaytruc = $request->input('lt_Ngaytruc');
        $giotruc = $request->input('lt_Giotruc');

        if (!is_array($giotruc) || empty($giotruc)) {
            return redirect()->back()->with('error', 'Bạn phải chọn ít nhất một giờ.');
        }

        // Lấy ID của bác sĩ từ bảng users dựa trên tên bác sĩ
        $user = User::where('name', $Tenbs)->first();
        $giotruc_list = implode(', ', $giotruc);

        if (!$user) {
            return redirect()->back()->with('error', 'Không tìm thấy bác sĩ với tên đã chọn.');
        }


        $user_id = $user->id; // Lấy ID của bác sĩ

        DB::table('lt_lichtruc')->insert([
            'lt_tenbs' => $Tenbs,
            'lt_Ngaytruc' => $ngaytruc,
            'lt_Giotruc' => $giotruc_list,
            'user_id' => $user_id,
        ]);


        return redirect()->back()->with('status', 'Lịch trực đã được thêm thành công.');
    }

    public function xemlichsap()
    {

        $this->data['title'] = "LỊCH TRỰC";


        $lichtruc = DB::table('lt_lichtruc')
            ->select('lt_Id', 'lt_tenbs', 'lt_Ngaytruc', 'lt_Giotruc', 'user_id')
            ->get();


        return view("Admin.layoutsAd.lichtruc.xemlichsap", $this->data, compact('lichtruc'));
    }

    public function sualichsap($id)
    {
        $this->data['title'] = "SỬA LỊCH TRỰC";
        $lichtruc = lt_lichtruc::where('lt_Id', $id)->first();

        $bacsi = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();

        return view("Admin.layoutsAd.lichtruc.sualichsap", $this->data, compact('bacsi', 'lichtruc'));
    }

    public function editlichsap(Request $request, $id)
    {
        $lichtruc = lt_lichtruc::where('lt_Id', $id)->first();

        $lt_tenbs = $request->input('lt_tenbs');
        $lt_Ngaytruc = $request->input('lt_Ngaytruc');
        $lt_Giotruc = $request->input('lt_Giotruc', []);
        $user_id = $request->input('user_id');


        if (!is_array($lt_Giotruc) || empty($lt_Ngaytruc)) {
            return redirect()->back()->with('error', 'Bạn phải chọn ít nhất một giờ.');
        }

        // Chuyển mảng giờ trực thành chuỗi
        $giotruc_list = implode(', ', $lt_Giotruc);

        // Kiểm tra xem đã có bản ghi nào cho ngày và bác sĩ cụ thể chưa
        $lichtruc = DB::table('lt_lichtruc')
            ->where('lt_tenbs', $lt_tenbs)
            ->where('lt_Ngaytruc', $lt_Ngaytruc)
            ->where('user_id', $user_id)
            ->first();

        if ($lichtruc) {

            DB::table('lt_lichtruc')
                ->where('lt_tenbs', $lt_tenbs)
                ->where('lt_Ngaytruc', $lt_Ngaytruc)
                ->where('user_id', $user_id)
                ->update([
                    'lt_Giotruc' => $giotruc_list,
                ]);
        } else {

            DB::table('lt_lichtruc')->insert([
                'lt_tenbs' => $lt_tenbs,
                'lt_Ngaytruc' => $lt_Ngaytruc,
                'lt_Giotruc' => $giotruc_list,
                'user_id' => $user_id,
            ]);
        }

        return redirect()->back()->with('status', 'Cập nhật thành công');
    }



    public function xoalichsap($id)
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
        $Nhanvien = DB::table('users')
            ->leftJoin('nhanvien', 'users.id', '=', 'nhanvien.id_user')
            ->select('users.id', 'users.name', 'users.phone', 'users.email', 'nhanvien.*')
            ->get();



        // Truyền dữ liệu đến view
        return view('Admin.layoutsAd.qlinhanvien', $this->data, compact('Nhanvien'));
    }

    // public function themnhanvien()
    // {
    //     $this->data['title'] = "THÊM NHÂN VIÊN";

    //     $chucvu = roles::all();

    //     return view("Admin.layoutsAd.nhanvien.addnv", $this->data, compact('chucvu'));
    // }

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

        // Tìm kiếm thông tin nhân viên bằng id_user
        $Nhanvien = DB::table('nhanvien')->where('id_user', $id)->first();

        // Nếu nhân viên không tồn tại, tạo bản ghi mới từ bảng users
        if (!$Nhanvien) {
            $user = DB::table('users')->where('id', $id)->first();

            // Tạo một đối tượng nhân viên với các thông tin cơ bản từ bảng users
            $Nhanvien = (object) [
                'NV_Id' => null,
                'NV_Avatar' => null,
                'NV_Ten' => $user->name,
                'NV_Birthday' => null,
                'NV_Gioitinh' => null,
                'NV_Diachi' => null,
                'NV_Email' => $user->email,
                'NV_Sdt' => $user->phone,
                'NV_Trinhdo' => null,
                'NV_Chucvu' => null,
                'NV_Gioithieu' => null,
                'id_user' => $user->id
            ];
        } else {
            $user = DB::table('users')->where('id', $Nhanvien->id_user)->first();
        }



        return view("Admin.layoutsAd.nhanvien.editnv", $this->data, compact('Nhanvien', 'chucvu', 'user'));
    }

    public function editnhanvien(Request $request, $id)
    {
        $this->data['title'] = "SỬA NHÂN VIÊN";

        // Lấy thông tin người dùng từ bảng users
        $user = DB::table('users')->where('id', $id)->first();

        // Kiểm tra nếu người dùng không tồn tại
        if (!$user) {
            return redirect()->route('Admin.quanlynhanvien')->with('error', 'Người dùng không tồn tại.');
        }

        // Tìm thông tin nhân viên theo id_user, nếu không có thì tạo mới
        $Nhanvien = DB::table('nhanvien')->where('id_user', $id)->first();
        if (!$Nhanvien) {
            // Nếu không tìm thấy thông tin nhân viên, tạo mới
            $Nhanvien = new nhanvien();
            // $Nhanvien->id_user = $id;  // Đặt id_user từ thông tin người dùng
        } else {
            // Nếu đã tồn tại thông tin nhân viên, lấy thông tin chi tiết
            $Nhanvien = nhanvien::find($Nhanvien->NV_Id);
        }

        if ($request->hasFile('NV_Avatar')) {
            // Xóa ảnh cũ nếu tồn tại
            $avtcu = 'uploads/avtnhanvien/' . $Nhanvien->NV_Avatar;
            if (File::exists($avtcu)) {
                File::delete($avtcu);
            }

            // Xử lý file mới
            $file = $request->file('NV_Avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/avtnhanvien/', $filename);

            $Nhanvien->NV_Avatar = $filename;
        }

        // Cập nhật các thuộc tính khác
        $Nhanvien->NV_Ten = $request->input('NV_Ten');
        $Nhanvien->NV_Birthday = $request->input('NV_Birthday');
        $Nhanvien->NV_Gioitinh = $request->input('NV_Gioitinh');
        $Nhanvien->NV_Diachi = $request->input('NV_Diachi');
        $Nhanvien->NV_Email = $request->input('NV_Email');
        $Nhanvien->NV_Sdt = $request->input('NV_Sdt');
        $Nhanvien->NV_Trinhdo = $request->input('NV_Trinhdo');
        $Nhanvien->NV_Chucvu = $request->input('NV_Chucvu');
        $Nhanvien->NV_Gioithieu = $request->input('NV_Gioithieu');
        $Nhanvien->id_user = $request->input('id_user');

        // Lưu thông tin vào cơ sở dữ liệu
        $Nhanvien->save();

        return redirect()->back()->with('status', 'Thông tin nhân viên đã được cập nhật.');
    }


    public function xoanhanvien($id_user)
    {
        // Tìm nhân viên dựa trên id_user trong bảng nhanvien
        $Nv = nhanvien::where('id_user', $id_user)->first();

        // Nếu có bản ghi trong bảng nhanvien, thực hiện xóa
        if ($Nv) {
            // Xóa ảnh đại diện nếu có
            $avt = 'uploads/avtnhanvien/' . $Nv->NV_Avatar;
            if (File::exists($avt)) {
                File::delete($avt);
            }

            // Xóa bản ghi nhân viên trong bảng nhanvien
            $Nv->delete();
        }

        // Xóa thông tin tương ứng trong bảng users
        $user = User::find($id_user);
        if ($user) {
            $user->delete();
        }

        // Chuyển hướng lại và hiển thị thông báo thành công
        return redirect()->back()->with('status', 'Xóa thành công!');
    }



    public function khothuoc()
    {

        $this->data['title'] = "KHO THUỐC";
        $khothuoc = DB::table('khothuoc')
            ->get();

        return view("Admin.layoutsAd..khothuoc.khothuoc", $this->data, compact('khothuoc'));
    }

    public function themthuoc()
    {

        $this->data['title'] = "THÊM THUỐC";
        return view("Admin.layoutsAd.khothuoc.themthuoc", $this->data);
    }

    public function postthemthuoc(Request $request)
    {
        khothuoc::create([
            'tenthuoc' => $request->input('tenthuoc'),
            'soluong' => $request->input('soluong'),
            'donvi' => $request->input('donvi'),
            'giathuoc' => $request->input('giathuoc'),
            'lieuluong' => $request->input('lieuluong'),
            'cachdung' => $request->input('cachdung'),
            'mota' => $request->input('mota'),
        ]);

        return  redirect()->back()->with('status', 'Thành công');
    }
    public function suathuoc($id)
    {

        $this->data['title'] = "SỬA THUỐC";
        $suathuoc = DB::table('khothuoc')
            ->where('id_thuoc', $id)
            ->first();

        return view("Admin.layoutsAd..khothuoc.suathuoc", $this->data, compact('suathuoc'));
    }

    public function postsuathuoc(Request $request, $id)
    {

        $thuoc = khothuoc::find($id);

        if (!$thuoc) {
            return redirect()->back()->with('error', 'Thuốc không tồn tại.');
        }

        $thuoc->update([
            'tenthuoc' => $request->input('tenthuoc'),
            'soluong' => $request->input('soluong'),
            'donvi' => $request->input('donvi'),
            'giathuoc' => $request->input('giathuoc'),
            'lieuluong' => $request->input('lieuluong'),
            'cachdung' => $request->input('cachdung'),
            'mota' => $request->input('mota'),
        ]);

        return redirect()->back()->with('status', 'Thành công.');
    }

    public function xoathuoc($id)
    {

        $thuoc = khothuoc::find($id);

        if (!$thuoc) {
            return redirect()->back()->with('error', 'Thuốc không tồn tại.');
        }


        $thuoc->delete();


        return redirect()->back()->with('status', 'Thành công.');
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
        $user = auth()->user(); // Lấy thông tin bác sĩ đã đăng nhập

        // Lấy tất cả bản ghi của bác sĩ từ bảng lt_lichtrucbs
        $lichtruc = DB::table('lt_lichtrucbs')
            ->select('lt_Idlt', 'lt_tenbacsi', 'lt_ngaytruc', 'lt_giotruc')
            ->where('user_id', $user->id)
            ->get();

        return view("Admin.doctors.doctor", array_merge($this->data, compact('user', 'lichtruc')));
    }


    public function postdoctor(Request $request)
    {
        $ten = $request->input('lt_tenbacsi');
        $ngaytruc = $request->input('lt_ngaytruc');
        $giotruc = $request->input('lt_giotruc'); // Đây sẽ là một mảng chứa các giờ đã chọn
        $userId = $request->input('user_id');

        if (!is_array($giotruc) || empty($giotruc)) {
            return redirect()->back()->with('error', 'Bạn phải chọn ít nhất một giờ.');
        }

        // Chuyển mảng giờ trực thành chuỗi
        $giotruc_list = implode(', ', $giotruc);

        // Kiểm tra xem đã có bản ghi nào cho ngày và bác sĩ cụ thể chưa
        $lichtruc = DB::table('lt_lichtrucbs')
            ->where('lt_giotruc', $giotruc_list)
            ->where('lt_ngaytruc', $ngaytruc)
            ->where('user_id', $userId)
            ->first();

        if ($lichtruc) {

            return redirect()->back()->with('error', 'Lịch trực đã tồn tại!');
        } else {
            // Nếu chưa có bản ghi, thêm mới
            DB::table('lt_lichtrucbs')->insert([
                'lt_tenbacsi' => $ten,
                'lt_ngaytruc' => $ngaytruc,
                'lt_giotruc' => $giotruc_list,
                'user_id' => $userId,
            ]);
        }

        return redirect()->back()->with('status', 'Lịch trực đã được đăng ký thành công!');
    }



    public function xemlichtruc()
    {

        $this->data['title'] = "LỊCH TRỰC";
        $user = auth()->user();
        $xemlichtruc = DB::table('lt_lichtruc')

            ->where('user_id', $user->id)
            ->get();


        return view("Admin.doctors.xemlichtruc", $this->data, compact('xemlichtruc'));
    }
    public function sualichtrucbs($id)
    {
        $user = auth()->user();
        $this->data['title'] = "SỬA LỊCH TRỰC";

        // Lấy bản ghi của bác sĩ trong ngày
        $sualichtruc = DB::table('lt_lichtrucbs')
            ->select('lt_Idlt', 'lt_tenbacsi', 'lt_ngaytruc', 'lt_giotruc')
            ->where('lt_Idlt', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$sualichtruc) {
            return back()->with('error', 'Không tìm thấy lịch trực');
        }

        $giotruc = $sualichtruc->lt_giotruc ? explode(', ', $sualichtruc->lt_giotruc) : [];

        return view("Admin.doctors.sualichtruc", array_merge($this->data, compact('user', 'sualichtruc', 'giotruc', 'id')));
    }




    public function postsualichtruc(Request $request, $id)
    {
        $user = auth()->user();
        $lt_tenbacsi = $request->input('lt_tenbacsi');
        $lt_ngaytruc = $request->input('lt_ngaytruc');
        $lt_giotruc = $request->input('lt_giotruc', []); // Mảng giờ trực từ request

        if (!is_array($lt_giotruc) || empty($lt_giotruc)) {
            return redirect()->back()->with('error', 'Bạn phải chọn ít nhất một giờ.');
        }

        // Chuyển mảng giờ trực thành chuỗi
        $giotruc_list = implode(', ', $lt_giotruc);

        // Kiểm tra xem đã có bản ghi nào cho ngày và bác sĩ cụ thể chưa
        $lichtruc = DB::table('lt_lichtrucbs')
            ->where('lt_tenbacsi', $lt_tenbacsi)
            ->where('lt_ngaytruc', $lt_ngaytruc)
            ->where('user_id', $user->id)
            ->first();

        if ($lichtruc) {

            DB::table('lt_lichtrucbs')
                ->where('lt_tenbacsi', $lt_tenbacsi)
                ->where('lt_ngaytruc', $lt_ngaytruc)
                ->where('user_id', $user->id)
                ->update([
                    'lt_giotruc' => $giotruc_list,
                ]);
        } else {

            DB::table('lt_lichtrucbs')->insert([
                'lt_tenbacsi' => $lt_tenbacsi,
                'lt_ngaytruc' => $lt_ngaytruc,
                'lt_giotruc' => $giotruc_list,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->back()->with('status', 'Cập nhật lịch trực thành công');
    }



    public function xoalichtrucbs($id)
    {


        $lichtruc = lt_lichtrucbs::where('lt_Idlt', $id)->first();



        $lichtruc->delete();

        return redirect()->back()->with('status', 'Xóa thành công  !');
    }
}
