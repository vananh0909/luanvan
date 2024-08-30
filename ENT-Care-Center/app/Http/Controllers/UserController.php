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
        // Xác thực người dùng và lấy thông tin người dùng
        // $user = Users::authenticate(
        //     $request->input('CUS_Phone'),
        //     $request->input('CUS_PASS')
        // );

        // if ($user) {
        //     // Đăng nhập thành công, lưu thông tin người dùng vào session
        //     session(['user' => $user]);

        //     // Chuyển hướng đến trang lịch khám
        //     return redirect()->route('User.lichkham');
        // } else {
        //     // Đăng nhập thất bại, chuyển hướng đến trang đăng nhập và hiển thị thông báo
        //     return redirect()->route('User.dangnhap')->with('error', 'Đăng nhập không thành công.');
        // }

        $login = $request->only('CUS_Phone', 'CUS_PASS');

        // Kiểm tra trong bảng `customer`
        $user = Users::where('CUS_Phone', $login['CUS_Phone'])->first();

        if ($customer && Hash::check($login['CUS_PASS'], $customer->CUS_PASS)) {
            session(['user' => $user]);
            return redirect()->route('User.lichkham');
        }

        // Nếu không tìm thấy trong bảng `customer`, kiểm tra trong bảng `user`
        $user = User::where('phone', $login['CUS_Phone'])->first();

        if ($user && Hash::check($login['CUS_PASS'], $user->password)) {
            Auth::login($user);
            // Lấy vai trò đầu tiên của người dùng
            $role = $user->roles->first();

            if ($role) {
                $roleName = $role->name;

                if ($roleName == 'doctor') {
                    return redirect()->route('User.bacsi'); // Điều hướng tới trang của bác sĩ
                } else {
                    return redirect()->back(); // Điều hướng tới trang lịch khám
                }
            } else {
                // Nếu không có vai trò, điều hướng tới trang đăng nhập với thông báo lỗi
                return redirect()->back()->with('error', 'Đăng nhập không thành công.');
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


    //bacsi

    public function bacsi()
    {
        $this->data['title'] = "BÁC SỸ";


        return view("layouts.doctor.doctor", $this->data);
    }



    public function lichhen()
    {
        $this->data['title'] = "LỊCH HẸN";
        // Thực hiện truy vấn để lấy ra thông tin của những người có lịch hẹn
        $Lichhen = DB::select('
        SELECT customer.*, lichhen.LH_BSkham, lichhen.LH_Id, lichhen.LH_Email, lichhen.LH_Ngaykham, lichhen.LH_Giokham, lichhen.LH_trieuchung
        FROM customer
        INNER JOIN lichhen ON customer.CUS_Id = lichhen.LH_CustomerID
        ORDER BY  LH_Ngaykham ASC');

        return view("layouts.doctor.lichhen", $this->data, compact('Lichhen'));
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


        // Kiểm tra xem có ID của người dùng trong session không
        if ($customerId) {
            $existingAppointment = lichhen::where('LH_BSkham', $request->LH_BSkham)
                ->where('LH_Ngaykham', $request->LH_Ngaykham)
                ->where('LH_Giokham', $request->LH_Giokham)
                ->exists();

            // Nếu có lịch khám trùng, trả về thông báo lỗi
            if ($existingAppointment) {
                return redirect()->back()->with('error', 'Lịch khám trùng với lịch đã có. Vui lòng chọn thời gian khác.');
            }
            // Tạo một mảng dữ liệu cho việc chèn vào bảng lichhen
            $data = [
                $customerId,
                $request->LH_BSkham,
                $request->LH_Ngaykham,
                $request->LH_Giokham,
                $request->LH_Email,
                $request->LH_trieuchung
            ];

            // Thực hiện chèn dữ liệu vào cơ sở dữ liệu
            $this->lichhen->addlichhen($data);

            return redirect()->route('User.lichkham2')->with('success', 'thành công');
        } else {
            return redirect()->route('User.Home')->with('error', 'thất bại');
        }
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
}
