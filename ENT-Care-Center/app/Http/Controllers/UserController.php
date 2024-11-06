<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use session;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\lichhen;
use Illuminate\Http\Request;
use App\Models\dv_dichvu1;
use App\Models\dv_dichvu2;
use App\Models\lt_lichtruc;
use App\Models\nhanvien;
use App\Models\lt_lichtrucbs;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Benhan;
use App\Models\DonThuoc;
use App\Models\lienhe;
use App\Models\KhoThuoc;
// băm pass
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class UserController extends Controller
{
    private $customer;
    private $lichhen;
    public $data = [];
    public function __construct()
    {
        $this->customer = new Users();
        $this->lichhen = new lichhen();
    }
    public function index()
    {

        $this->data['title'] = "TRANG CHỦ";
        $bacsitruc = DB::table('nhanvien')
            ->join('lt_lichtruc', 'nhanvien.id_user', '=', 'lt_lichtruc.user_id')
            ->select('nhanvien.*', 'lt_lichtruc.*') // Chọn tất cả các cột từ cả hai bảng
            ->orderBy('lt_Ngaytruc', 'desc')
            ->take(3)
            ->distinct()
            ->get();

        return view("Home", $this->data, compact('bacsitruc'));
    }


    public function dangky(Request $request)
    {
        $emailExists = Users::where('CUS_Email', $request->CUS_Email)->exists();
        $phoneExists = Users::where('CUS_Phone', $request->CUS_Phone)->exists();

        // Nếu email hoặc số điện thoại đã tồn tại, trả về lỗi
        if ($phoneExists || $emailExists) {
            return back()->with('error', 'Email hoặc số điện thoại đã tồn tại!');
        }

        $customer = new Users;
        $customer->CUS_Name = $request->input('CUS_Name');
        $customer->CUS_PASS = Hash::make($request->input('CUS_PASS'));
        $customer->CUS_Birthday = $request->input('CUS_Birthday');
        if ($request->hasFile('CUS_Avatar')) {
            $file = $request->file('CUS_Avatar');
            $extension = $file->getClientOriginalExtension(); //lay ten mo rong duoi jpg, png,..
            $filename = time() . '.' . $extension;
            $file->move('uploads/avtkhachhang/', $filename); //upload lên thư mục
            $customer->CUS_Avatar = $filename;
        }
        $customer->CUS_Phone = $request->input('CUS_Phone');
        $customer->CUS_Email = $request->input('CUS_Email');
        $customer->CUS_Address = $request->input('CUS_Address');
        $customer->CUS_Gender = $request->input('CUS_Gender');
        $customer->CUS_Nganhang = $request->input('CUS_Nganhang');
        $customer->CUS_Stk = $request->input('CUS_Stk');



        $customer->save();

        // Thêm khách hàng vào cơ sở dữ liệu
        // $this->customer->addCustomer($dataInsert);

        // Lưu ID vào session
        session(['user' => $this->customer->id]);

        return redirect()->route('User.dangnhap')->with('msg', 'Đăng ký thành công!');
    }


    public function dangnhap()
    {
        $this->data['title'] = 'ĐĂNG NHẬP';


        return view("layouts.dangnhap", $this->data);
    }

    public function postdangnhap(Request $request)
    {


        $login = $request->only('CUS_Phone', 'CUS_PASS');

        // Kiểm tra trong bảng `customer`
        $user = Users::where('CUS_Phone', $login['CUS_Phone'])->first();

        if ($user && Hash::check($login['CUS_PASS'], $user->CUS_PASS)) {
            session(['user' => $user]);
            return redirect()->route('User.lichkham');
        }

        // Nếu không tìm thấy trong bảng `customer`, kiểm tra trong bảng `user`
        $doctor = User::where('phone', $login['CUS_Phone'])->first();

        if ($doctor && Hash::check($login['CUS_PASS'], $doctor->password)) {
            Auth::login($doctor);
            // Lấy vai trò đầu tiên của người dùng
            $role = $doctor->roles->first();

            if ($role) {
                $roleName = $role->name;

                if ($roleName == 'doctor') {
                    return redirect()->route('User.bacsi'); // Điều hướng tới trang của bác sĩ
                } else {
                    return redirect()->back(); // Điều hướng tới trang lịch khám
                }
            }
        }

        // Nếu không tìm thấy thông tin cả trong bảng `customer` và `user`
        return redirect()->back()->with('error', 'Số điện thoại hoặc mật khẩu không đúng.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('User.Home');
    }



    public function lichtruc()
    {
        $this->data['title'] = "DANH SÁCH BÁC SĨ TRỰC";
        $bacsitruc = DB::table('nhanvien')
            ->join('lt_lichtruc', 'nhanvien.id_user', '=', 'lt_lichtruc.user_id')
            ->select('nhanvien.*', 'lt_lichtruc.*') // Chọn tất cả các cột từ cả hai bảng
            ->orderBy('lt_Ngaytruc', 'desc')

            ->get();


        return view("layouts.lichtruc", $this->data, compact('bacsitruc'));
    }


    public function lichkham()
    {
        $this->data['title'] = "ĐẶT LỊCH KHÁM";

        // Lấy ngày hiện tại
        $ngayHienTai = date('Y-m-d');

        // Tính toán ngày kết thúc là 6 ngày sau
        $ngayKetThuc = date('Y-m-d', strtotime($ngayHienTai . ' + 6 days'));

        // Lấy danh sách bác sĩ trực trong khoảng từ ngày hiện tại đến 6 ngày sau
        $bacsitruc = lt_lichtruc::whereBetween('lt_Ngaytruc', [$ngayHienTai, $ngayKetThuc])->get();

        return view("layouts.lichkham", $this->data, compact('bacsitruc'));
    }

    public function postlichkham(Request $request)
    {
        // Lấy ID của người dùng từ session
        $customerId = session('user')['CUS_Id'];
        if (!$customerId) {
            return redirect()->route('User.Home')->with('error', 'Thất bại');
        }

        // Lấy ngày hiện tại
        $ngayhientai = date('Y-m-d');

        if ($request->LH_Ngaykham < $ngayhientai) {
            return redirect()->back()->with('error', 'Không thể chọn ngày đã qua. Vui lòng chọn ngày hợp lệ.');
        }

        // Tìm bác sĩ theo tên
        $user = User::where('name', $request->LH_BSkham)->first();
        $id_user = $user->id;
        // Kiểm tra xem có tìm thấy người dùng không
        if (!$user) {
            return redirect()->back()->with('error', 'Không tìm thấy bác sĩ với tên đã chọn.');
        }

        $giotruc = lt_lichtruc::where('user_id', $id_user)
            ->where('lt_Ngaytruc', $request->LH_Ngaykham)
            ->where('lt_Giotruc', 'LIKE', '%' . $request->LH_Giokham . '%') // Kiểm tra xem giờ có nằm trong chuỗi giờ trực không
            ->exists();

        if (!$giotruc) {
            return redirect()->back()->with('error', 'Bác sĩ không trực vào giờ này. Vui lòng chọn giờ khác.');
        }

        $lichhen = lichhen::where('LH_BSkham', $request->LH_BSkham)
            ->where('LH_Ngaykham', $request->LH_Ngaykham)
            ->where('LH_Giokham', $request->LH_Giokham)
            ->exists();

        if ($lichhen) {
            return redirect()->back()->with('error', 'Lịch khám trùng với lịch đã có. Vui lòng chọn thời gian khác.');
        }


        $data = [
            'LH_CustomerID' => $customerId,
            'id_user' => $id_user,
            'LH_BSkham' => $request->LH_BSkham,
            'LH_Ngaykham' => $request->LH_Ngaykham,
            'LH_Giokham' => $request->LH_Giokham,
            'LH_Email' => $request->LH_Email,
            'LH_trieuchung' => $request->LH_trieuchung,
        ];

        $this->lichhen->create($data);

        return redirect()->route('User.lichkham2')->with('success', 'Thành công');
    }


    public function lichkham2()
    {
        $this->data['title'] = "ĐẶT LỊCH KHÁM";
        $userModel = new Users();
        $allData = $userModel->getAllData();


        return view("layouts.lichkham2", $this->data, ['allData' => $allData]);
    }


    public function doctors()
    {
        $this->data['title'] = "DANH SÁCH BÁC SĨ";
        $bacsi = DB::table('nhanvien')->where('NV_Chucvu', 'doctor')->get();
        return view("layouts.doctors", $this->data, compact('bacsi'));
    }

    public function dichvu()
    {
        $this->data['title'] = "GÓI DỊCH VỤ";
        $Dichvu1 = dv_dichvu1::all();
        $Dichvu2 = dv_dichvu2::all();
        return view("layouts.dichvu", $this->data, compact('Dichvu1', 'Dichvu2'));
    }

    public function Setting()
    {
        $this->data['title'] = 'CÀI ĐẶT TÀI KHOẢN';

        // $customerList = $this->customer->getAllUser();

        return view(
            "layouts.Setting",
            $this->data,
        );
    }

    public function suatrangcanhan($id)
    {

        $this->data['title'] = 'SỬA THÔNG TIN';
        $userId = session('user')['CUS_Id'];
        $trangcn = DB::table('customer')
            ->where('customer.CUS_Id',  $userId)
            ->first();
        return view("layouts.suatrangcanhan", $this->data, compact('trangcn'));
    }

    public function posttrangcanhan(Request $request, $id)
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
        // Cập nhật lại session
        session(['user' => $kh]);
        return redirect()->back()->with('status', 'Cập nhật thành công !');
    }

    public function lichsukham()
    {
        $this->data['title'] = 'LỊCH SỬ KHÁM';
        $userId = session('user')['CUS_Id'] ?? null;


        if ($userId) {
            $lichhen = DB::table('lichhen')
                ->join('benhan', 'lichhen.LH_Id', '=', 'benhan.id_lh')
                ->join('donthuoc', 'benhan.id_benhan', '=', 'donthuoc.id_benhan')
                ->where('lichhen.LH_CustomerID', $userId)
                ->orderBy('lichhen.LH_Ngaykham', 'DESC')
                ->select('lichhen.*', 'benhan.*', 'donthuoc.*')
                ->get();
        } else {
            $lichhen = collect(); //không có userId  khởi tạo collection rỗng
        }

        return view("layouts.lichsukham", array_merge($this->data, compact('lichhen', 'userId')));
    }


    public function huylichhen()
    {
        $this->data['title'] = "LỊCH KHÁM";
        $userId = session('user')['CUS_Id'] ?? null;
        if ($userId) {
            $lichhen = DB::table('lichhen')
                ->where('lichhen.LH_CustomerID', $userId)
                ->orderBy('lichhen.LH_Ngaykham', 'desc')
                ->get();
        } else {
            $lichhen = collect(); //không có userId  khởi tạo collection rỗng
        }


        return view("layouts.huylichhen", $this->data, compact('lichhen', 'userId'));
    }
    public function posthuylichhen($id)
    {
        // Tìm lịch hẹn theo ID
        $lichhen = lichhen::find($id);
        if (!$lichhen) {
            return redirect()->route('User.Home')->with('error', 'Không tìm thấy lịch hẹn.');
        }

        $TimeNow = Carbon::now();

        //  thời gian hẹn khám từ lịch hẹn
        $time = Carbon::parse($lichhen->LH_Ngaykham . ' ' . $lichhen->LH_Giokham);

        // nếu thời gian hiện tại lớn hơn hoặc bằng thời gian hẹn khám - 1 ngày
        if ($TimeNow->diffInDays($time) < 1) {
            return redirect()->back()->with('error', 'Bạn chỉ có thể hủy lịch hẹn trước 1 ngày.');
        }


        $lichhen->delete();

        return redirect()->route('User.Home')->with('success', 'Lịch hẹn đã được hủy thành công.');
    }


    public function lienhe()
    {
        $this->data['title'] = 'LIÊN HỆ';

        return view('layouts.lienhe', $this->data);
    }

    public function postlienhe(Request $request)
    {
        $benhan = lienhe::create([

            'ten'        => $request->input('ten'),
            'email'  => $request->input('email'),
            'phone'    => $request->input('phone'),
            'mess'    => $request->input('mess')

        ]);
        return redirect()->back()->with('status', 'Thông tin được gửi thành công!');
    }


    public function showPassword()
    {
        $showPassword = false; // hoặc true nếu muốn hiện mật khẩu ngay từ đầu
        return view("layouts.dangnhap", compact('showPassword'));
    }

    public function xacnhan()
    {

        $allData = $this->getAllData();
        dd($allData);
        // Gọi hàm để lấy dữ liệu
        // return view('User.lichkham2', ['allData' => $allData]); // Trả về view và truyền biến $allData
    }

    public function sendmail()
    {
        $name = session('user')['CUS_Name']; // Lấy thông tin người dùng từ session
        $lichhenModel = new lichhen();
        $lichhen = $lichhenModel->getLichHen();
        if ($lichhen) {
            // Lấy địa chỉ email từ dữ liệu lịch hẹn
            $emailAddress = $lichhen[0]->LH_Email;

            // Gửi email
            Mail::send('email.send', compact('name', 'lichhen'), function ($email) use ($name, $emailAddress) {
                $email->subject('ENT CARE CENTER xin thông báo !');
                $email->to($emailAddress, $name);
            });
        }
        return redirect()->back();
    }



    //BÁC SĨ

    public function bacsi()
    {
        $this->data['title'] = "BÁC SỸ";


        return view("layouts.doctor.doctor", $this->data);
    }



    public function lichhen()
    {
        $this->data['title'] = "LỊCH HẸN";
        $user = auth()->user();
        $Lichhen = DB::table('customer')
            ->join('lichhen', 'customer.CUS_Id', '=', 'lichhen.LH_CustomerID')
            ->select(
                'customer.*',
                'lichhen.LH_BSkham',
                'lichhen.LH_Id',
                'lichhen.LH_Email',
                'lichhen.LH_Ngaykham',
                'lichhen.LH_Giokham',
                'lichhen.LH_trieuchung',
                'lichhen.LH_trangthai'
            )
            ->where('lichhen.id_user', $user->id)
            ->orderBy('lichhen.LH_Ngaykham', 'desc')
            ->get();


        return view("layouts.doctor.lichhen", $this->data, compact('Lichhen'));
    }

    public function dklichtruc()
    {
        $this->data['title'] = "ĐĂNG KÝ LỊCH TRỰC";
        $this->data['title'] = "BÁC SĨ";
        $user = auth()->user();

        $lichtruc = DB::table('lt_lichtrucbs')
            ->select('lt_Idlt', 'lt_tenbacsi', 'lt_ngaytruc', 'lt_giotruc')
            ->where('user_id', $user->id)
            ->get();

        return view("layouts.doctor.dklichtruc", $this->data, compact('user', 'lichtruc'));
    }

    public function postdklichtruc(Request $request)
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



    public function sualichtrucdk($id)
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

        return view("layouts.doctor.sualichtrucdk", $this->data, compact('user', 'sualichtruc', 'giotruc', 'id'));
    }

    public function postsualichtrucdk(Request $request, $id)
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


    public function xoalichtrucdk($id)
    {


        $lichtruc = lt_lichtrucbs::where('lt_Idlt', $id)->first();



        $lichtruc->delete();

        return redirect()->back()->with('status', 'Xóa thành công  !');
    }


    public function xemlichtrucbs()
    {

        $this->data['title'] = "LỊCH TRỰC";
        $user = auth()->user();
        $xemlichtruc = DB::table('lt_lichtruc')

            ->where('user_id', $user->id)
            ->orderBy('lt_lichtruc.lt_Ngaytruc', 'desc')
            ->get();

        return view("layouts.doctor.xemlichtruc", $this->data, compact('xemlichtruc'));
    }
    public function khambenh($id)
    {
        $this->data['title'] = "KHÁM BỆNH";
        $user = auth()->user();

        $benhnhan = DB::table('customer')
            ->join('lichhen', 'customer.CUS_Id', '=', 'lichhen.LH_CustomerID')
            ->select(
                'customer.*',
                'lichhen.LH_BSkham',
                'lichhen.LH_Id',
                'lichhen.LH_Email',
                'lichhen.LH_Ngaykham',
                'lichhen.LH_Giokham',
                'lichhen.LH_trieuchung',
                'lichhen.LH_trangthai'
            )
            ->where('lichhen.id_user', $user->id)
            ->where('lichhen.LH_Id', $id)
            ->orderBy('lichhen.LH_Ngaykham', 'ASC')
            ->first();

        if (!$benhnhan) {
            return redirect()->back()->with('error', 'Bệnh nhân không được tìm thấy.');
        }

        $dichvu = DB::table('dv_dichvu1')->get();
        $khothuoc = DB::table('khothuoc')->orderBy('tenthuoc', 'asc')->get();


        return view("layouts.doctor.khambenh", $this->data, compact('benhnhan', 'khothuoc', 'dichvu'));
    }


    public function postbenhandonthuoc(Request $request)
    {


        $tenthuoc = $request->input('tenthuoc');
        $lieuluong = $request->input('lieuluong');
        $cachsd = $request->input('cachsd');
        $soluong = $request->input('soluong');
        $tonggia_thuoc = 0;
        $thongbao_thuoc = [];

        foreach ($tenthuoc as $index => $ten) {

            $thuoc = DB::table('khothuoc')->where('tenthuoc', $ten)->first();
            if ($thuoc) {
                // Kiểm tra số lượng thuốc trong kho so với ngưỡng tối thiểu
                if ($thuoc->soluong <= $thuoc->nguongtoithieu) {
                    $thongbao_thuoc[] = "Thuốc $ten đã hết hàng. Vui lòng chọn loại thuốc khác.";
                }
                $tongtien_thuoc = $thuoc->giathuoc * $soluong[$index];
                $tonggia_thuoc += $tongtien_thuoc;
            }
            DB::table('khothuoc')->where('tenthuoc', $ten)->decrement('soluong', $soluong[$index]);
        }
        // Trả về thông báo nếu có thuốc gần hết hoặc hết hàng
        if (!empty($thongbao_thuoc)) {
            return redirect()->back()->with('warnings', $thongbao_thuoc);
        }

        $benhan = benhan::create([
            'id_lh'      => $request->input('id_lh'),
            'ten'        => $request->input('ten'),
            'chuandoan'  => $request->input('chuandoan'),
            'huyetap'    => $request->input('huyetap'),
            'nhiptim'    => $request->input('nhiptim'),
            'nhietdo'    => $request->input('nhietdo'),
            'ghichu'     => $request->input('ghichu'),
        ]);

        $dichvukham = $request->input('dichvukham');
        $dichvu = DB::table('dv_dichvu1')->where('DV_Tendv', $dichvukham)->first();
        $DV_Gia = $dichvu ? $dichvu->DV_Gia : 0;


        $tonggia = $tonggia_thuoc + $DV_Gia;

        DonThuoc::create([
            'id_benhan'  => $benhan->id_benhan,
            'tenthuoc'   => implode(',', $tenthuoc),
            'lieuluong'  => implode(',', $lieuluong),
            'soluong'    => implode(',', $soluong),
            'cachsd'     => implode(',', $cachsd),
            'tonggia'    => $tonggia,
            'dichvukham' => $dichvukham,
        ]);
        // Cập nhật trạng thái lịch hẹn trong bảng lichhen
        DB::table('lichhen')
            ->where('LH_Id', $benhan->id_lh) // Lấy LH_Id từ bảng benhan
            ->update(['LH_trangthai' => 1]);
        $id_benhan = $benhan->id_benhan;
        return redirect()->route('User.donthuoc', ['id' => $id_benhan]);
    }


    public function donthuoc($id)
    {

        $this->data['title'] = "ĐƠN THUỐC";
        $user = auth()->user();
        // Truy vấn lấy thông tin đơn thuốc, bệnh nhân và khách hàng
        $donthuoc = DB::table('donthuoc')
            ->join('benhan', 'donthuoc.id_benhan', '=', 'benhan.id_benhan')
            ->join('lichhen', 'benhan.id_lh', '=', 'lichhen.LH_Id')
            ->join('customer', 'lichhen.LH_CustomerID', '=', 'customer.CUS_Id')
            ->where('donthuoc.id_benhan', $id)
            ->select('donthuoc.*', 'benhan.*', 'lichhen.*', 'customer.*')
            ->first();


        return view("layouts.doctor.donthuoc", $this->data, compact('donthuoc', 'user'));
    }

    public function benhan($id)
    {

        $this->data['title'] = "BỆNH ÁN";
        $user = auth()->user();
        $benhan = DB::table('benhan')
            ->join('donthuoc', 'benhan.id_benhan', '=', 'donthuoc.id_benhan')
            ->join('lichhen', 'benhan.id_lh', '=', 'lichhen.LH_Id')
            ->join('customer', 'lichhen.LH_CustomerID', '=', 'customer.CUS_Id')
            ->where('customer.CUS_Id', $id) // Lọc bệnh án theo bệnh nhân
            ->select('donthuoc.*', 'benhan.*', 'lichhen.*', 'customer.*')
            ->get();  // Sử dụng get() để lấy toàn bộ bệnh án của bệnh nhân



        $firstLhId = $benhan->first()->LH_Id;

        return view("layouts.doctor.benhan", $this->data, compact('benhan', 'firstLhId'));
    }

    public function trangcanhan()
    {

        $this->data['title'] = "TRANG CÁ NHÂN";
        $user = auth()->user();

        $users = DB::table('users')
            ->where('users.id', $user->id)
            ->first();
        return view('layouts.doctor.xemtrang', $this->data, compact('users', 'user'));
    }
    public function suathongtin($id)
    {

        $this->data['title'] = "SỬA TRANG CÁ NHÂN";
        $user = auth()->user();

        $users = DB::table('users')
            ->where('users.id', $id)
            ->first();
        return view('layouts.doctor.suathongtin', $this->data, compact('users', 'user'));
    }

    public function postsuathongtin(Request $request, $id)
    {
        $thongtin = user::where('id', $id)->first();

        if (!$thongtin) {
            return redirect()->back()->with('error', 'Thuốc không tồn tại.');
        }

        $thongtin->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),

        ]);

        return redirect()->route('User.trangcanhan')->with('status', 'Thành công.');
    }

    public function lichsukhambs()
    {
        $this->data['title'] = 'LỊCH SỬ KHÁM';
        $userId = auth()->user();
        $lskham = DB::table('lichhen')
            ->join('benhan', 'lichhen.LH_Id', '=', 'benhan.id_lh')
            ->join('donthuoc', 'benhan.id_benhan', '=', 'donthuoc.id_benhan')
            ->join('customer', 'lichhen.LH_CustomerID', '=', 'customer.CUS_Id')
            ->where('lichhen.id_user', $userId->id)
            ->orderBy('lichhen.LH_Ngaykham', 'DESC')
            ->select('lichhen.*', 'benhan.*', 'donthuoc.*', 'customer.*') // Lấy tất cả thông tin từ các bảng
            ->get();


        return view("layouts.doctor.lichsukhambs", $this->data, compact('lskham', 'userId'));
    }
}
