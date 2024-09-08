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
// băm pass
use Illuminate\Support\Facades\Hash;



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
        // $bacsitruc = DB::table('nhanvien')
        //     ->join('lt_lichtruc', 'nhanvien.NV_Ten', '=', 'lt_lichtruc.lt_tenbacsi')
        //     ->select('nhanvien.*', 'lt_lichtruc.*') // Chọn tất cả các cột từ cả hai bảng
        //     ->distinct()
        //     ->orderBy('lt_lichtruc.lt_Id', 'desc') // Sắp xếp theo khóa chính của bảng lt_lichtruc
        //     ->take(3) // Giới hạn chỉ trả về 3 bản ghi
        //     ->get();

        return view("Home", $this->data);
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
            ->join('lt_lichtruc', 'nhanvien.NV_Ten', '=', 'lt_lichtruc.lt_tenbacsi')
            ->select('nhanvien.*', 'lt_lichtruc.*') // Chọn tất cả các cột từ cả hai bảng
            ->distinct()
            ->get();


        return view("layouts.lichtruc", $this->data, compact('bacsitruc'));
    }


    public function lichkham()
    {
        $this->data['title'] = "ĐẶT LỊCH KHÁM";

        // Lấy ngày hiện tại theo lịch dương
        $ngayHienTai = date('Y-m-d');

        $bacsitruc = lt_lichtruc::whereDate('lt_Ngaytruc', $ngayHienTai)->get();

        return view("layouts.lichkham", $this->data, compact('bacsitruc'));
    }

    public function postlichkham(Request $request)
    {
        // Lấy ID của người dùng từ session
        $customerId = session('user')['CUS_Id'];
        if (!$customerId) {
            return redirect()->route('User.Home')->with('error', 'Thất bại');
        }

        // Tìm bác sĩ theo tên
        $user = User::where('name', $request->LH_BSkham)->first();

        // Kiểm tra xem có tìm thấy người dùng không
        if (!$user) {
            return redirect()->back()->with('error', 'Không tìm thấy bác sĩ với tên đã chọn.');
        }

        $lichhen = lichhen::where('LH_BSkham', $request->LH_BSkham)
            ->where('LH_Ngaykham', $request->LH_Ngaykham)
            ->where('LH_Giokham', $request->LH_Giokham)
            ->exists();

        if ($lichhen) {
            return redirect()->back()->with('error', 'Lịch khám trùng với lịch đã có. Vui lòng chọn thời gian khác.');
        }

        $id_user = $user->id;


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
        $bacsi = DB::table('nhanvien')->where('NV_Chucvu', 'Bác sĩ')->get();
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
            // compact('customerList')
        );
    }


    public function lichsukham()
    {
        $this->data['title'] = 'LỊCH SỬ KHÁM';
        $userId = session('user')['CUS_Id'];

        // Lấy lịch hẹn của người dùng đó từ cơ sở dữ liệu
        $lichhen = lichhen::where('LH_CustomerID', $userId)->orderBy('LH_Ngaykham', 'DESC')->get();

        return view("layouts.lichsukham", $this->data, compact('lichhen'));
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



    //bacsi

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
                'lichhen.LH_trieuchung'
            )
            ->where('lichhen.id_user', $user->id)
            ->orderBy('lichhen.LH_Ngaykham', 'ASC')
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
            ->get();

        return view("layouts.doctor.xemlichtruc", $this->data, compact('xemlichtruc'));
    }

    public function khambenh($id)
    {

        $this->data['title'] = "KHÁM  BỆNH";
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
                'lichhen.LH_trieuchung'
            )
            ->where('lichhen.id_user', $user->id)
            ->where('lichhen.LH_Id', $id)
            ->orderBy('lichhen.LH_Ngaykham', 'ASC')
            ->first();

        return view("layouts.doctor.khambenh", $this->data, compact('benhnhan'));
    }

    public function postbenhandonthuoc(Request $request)
    {
        // 1. Lưu thông tin bệnh án vào bảng 'benhan' và lấy id_benhan
        $benhan = benhan::create([
            'id_lh'      => $request->input('id_lh'),
            'ten'        => $request->input('ten'),
            'chuandoan'  => $request->input('chuandoan'),
            'huyetap'    => $request->input('huyetap'),
            'nhiptim'    => $request->input('nhiptim'),
            'nhietdo'    => $request->input('nhietdo'),
            'ghichu'     => $request->input('ghichu'),
        ]);

        $tenthuoc = implode(',', $request->input('tenthuoc'));
        $lieuluong = implode(',', $request->input('lieuluong'));
        $cachsd = implode(',', $request->input('cachsd'));

        // Tạo mới một đơn thuốc và lưu vào cơ sở dữ liệu
        DonThuoc::create([
            'id_benhan'  => $benhan->id_benhan,
            'tenthuoc' => $tenthuoc,
            'lieuluong' => $lieuluong,
            'cachsd' => $cachsd,
        ]);

        return redirect()->back()->with('status', 'Lưu bệnh án và kê đơn thành công');
    }
}
