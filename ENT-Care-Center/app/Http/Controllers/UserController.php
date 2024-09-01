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
        // Thực hiện truy vấn để lấy ra thông tin của những người có lịch hẹn
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
        $user = auth()->user(); // Lấy thông tin bác sĩ đã đăng nhập
        $lichtruc = DB::table('lt_lichtrucbs')
            ->select(
                'lt_tenbacsi',
                'lt_ngaytruc',
                DB::raw('GROUP_CONCAT(lt_Idlt ORDER BY lt_Idlt ASC SEPARATOR ", ") as id_list'),
                DB::raw('GROUP_CONCAT(lt_giotruc ORDER BY lt_giotruc ASC SEPARATOR ", ") as giotruc_list')
            )
            ->groupBy('lt_tenbacsi', 'lt_ngaytruc')
            ->where('user_id', $user->id)
            ->get();

        return view("layouts.doctor.dklichtruc", $this->data, compact('user', 'lichtruc'));
    }


    public function sualichtrucdk($id)
    {
        $user = auth()->user();
        $this->data['title'] = "SỬA LỊCH TRỰC";

        // Lấy bản ghi của bác sĩ trong ngày
        // Giả sử bạn đã có biến $user lưu thông tin người dùng đang đăng nhập
        $sualichtruc = DB::table('lt_lichtrucbs')
            ->select(
                'lt_tenbacsi',
                'lt_ngaytruc',
                DB::raw('GROUP_CONCAT(DISTINCT lt_Idlt ORDER BY lt_Idlt ASC SEPARATOR ", ") as id_list'),
                DB::raw('GROUP_CONCAT(DISTINCT lt_giotruc ORDER BY lt_giotruc ASC SEPARATOR ", ") as giotruc_list')
            )
            ->where('user_id', $user->id) // Kiểm tra user_id khớp với ID của người dùng đang đăng nhập
            ->groupBy('lt_tenbacsi', 'lt_ngaytruc')
            ->first();

        if ($sualichtruc) {
            $giotruc = explode(', ', $sualichtruc->giotruc_list);
            $id_list = explode(', ', $sualichtruc->id_list);

            $first_id = $id_list[0];
        } else {
            $giotruc = [];
            $id_list = [];
        }



        return view("layouts.doctor.sualichtrucdk", $this->data, compact('user', 'sualichtruc', 'giotruc', 'first_id'));
    }
}
