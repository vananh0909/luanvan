<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\TinnhanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

Route::get('sendmail', [UserController::class, 'sendmail'])->name('sendmail');
Route::get('nguoidung', [TinnhanController::class, 'nguoidung'])->name('nguoidung');
Route::get('tinnhan', [TinnhanController::class, 'tinnhan'])->name('tinnhan');

#Admin
Route::prefix('Admin')->name('Admin.')->middleware(['auth', 'checkroles', 'logout'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('Homead');
    Route::get('trangchu', [AdminController::class, 'trangchu'])->name('trangchu');
    Route::get('quanlylichhen', [AdminController::class, 'quanlylichhen'])->name('quanlylichhen');
    Route::get('quanlybenhnhan', [AdminController::class, 'quanlybenhnhan'])->name('quanlybenhnhan');
    Route::get('suathongtin/{id}', [AdminController::class, 'suathongtin'])->name('suathongtin');
    Route::post('editthongtin/{id}', [AdminController::class, 'editthongtin'])->name('editthongtin');
    Route::get('xoabenhnhan/{id}', [AdminController::class, 'xoabenhnhan'])->name('xoabenhnhan');
    Route::get('quanlybacsy', [AdminController::class, 'quanlybacsy'])->name('quanlybacsy')->middleware('adminquanly');
    Route::post('postlichtruc', [AdminController::class, 'postlichtruc'])->name('postlichtruc');
    Route::get('xemlichsap', [AdminController::class, 'xemlichsap'])->name('xemlichsap');
    Route::get('sualichsap/{id}', [AdminController::class, 'sualichsap'])->name('sualichsap');
    Route::post('editlichsap/{id}', [AdminController::class, 'editlichsap'])->name('editlichsap');
    Route::post('xoalichsap/{id}', [AdminController::class, 'xoalichsap'])->name('xoalichsap');
    Route::get('quanlydichvu', [AdminController::class, 'quanlydichvu'])->name('quanlydichvu')->middleware('adminquanly');
    Route::get('themdichvu', [AdminController::class, 'themdichvu'])->name('themdichvu');
    Route::get('themgoidichvu', [AdminController::class, 'themgoidichvu'])->name('themgoidichvu');
    Route::post('themdichvu', [AdminController::class, 'postdichvu1'])->name('postdichvu1');
    Route::get('suadichvu/{id}', [AdminController::class, 'suadichvu'])->name('suadichvu');
    Route::post('editdichvu/{id}', [AdminController::class, 'editdichvu'])->name('editdichvu');
    Route::get('xoadichvu/{id}', [AdminController::class, 'xoadichvu'])->name('xoadichvu');
    Route::get('suagoidichvu/{id}', [AdminController::class, 'suagoidichvu'])->name('suagoidichvu');
    Route::post('editgoidichvu/{id}', [AdminController::class, 'editgoidichvu'])->name('editgoidichvu');
    Route::get('xoagoidichvu/{id}', [AdminController::class, 'xoagoidichvu'])->name('xoagoidichvu');
    Route::post('themgoidichvu', [AdminController::class, 'postdichvu2'])->name('postdichvu2');
    Route::get('quanlynhanvien', [AdminController::class, 'quanlynhanvien'])->name('quanlynhanvien')->middleware('adminquanly');
    Route::get('themnhanvien', [AdminController::class, 'themnhanvien'])->name('themnhanvien');
    Route::post('themnhanvien', [AdminController::class, 'postnhanvien'])->name('postnhanvien');
    Route::get('suanhanvien/{id}', [AdminController::class, 'suanhanvien'])->name('suanhanvien');
    Route::post('editnhanvien/{id}', [AdminController::class, 'editnhanvien'])->name('editnhanvien');
    Route::get('xoanhanvien/{id}', [AdminController::class, 'xoanhanvien'])->name('xoanhanvien');
    Route::get('thongkebaocao', [AdminController::class, 'thongkebaocao'])->name('thongkebaocao');
    Route::post('thongke', [AdminController::class, 'thongke'])->name('thongke');
    Route::get('khothuoc', [AdminController::class, 'khothuoc'])->name('khothuoc');
    Route::get('themthuoc', [AdminController::class, 'themthuoc'])->name('themthuoc');
    Route::post('postthemthuoc', [AdminController::class, 'postthemthuoc'])->name('postthemthuoc');
    Route::get('suathuoc/{id}', [AdminController::class, 'suathuoc'])->name('suathuoc');
    Route::post('suathuoc/{id}', [AdminController::class, 'postsuathuoc'])->name('postsuathuoc');
    Route::post('xoathuoc/{id}', [AdminController::class, 'xoathuoc'])->name('xoathuoc');
    Route::get('thanhtoan', [AdminController::class, 'thanhtoan'])->name('thanhtoan');
    Route::post('trangthai/{id}', [AdminController::class, 'trangthai'])->name('trangthai');


    Route::get('doctor', [AdminController::class, 'doctor'])->name('doctor')->middleware('admindoctor');
    Route::post('doctor', [AdminController::class, 'postdoctor'])->name('postdoctor');
    Route::get('xemlichtruc', [AdminController::class, 'xemlichtruc'])->name('xemlichtruc');
    Route::get('sualichtruc/{id}', [AdminController::class, 'sualichtrucbs'])->name('sualichtruc');
    Route::post('sualichtruc/{id}', [AdminController::class, 'postsualichtruc'])->name('postsualichtruc');
    Route::post('xoalichtruc/{id}', [AdminController::class, 'xoalichtrucbs'])->name('xoalichtrucbs');
});

//phan quyen
Route::get('auth', [AuthController::class, 'auth'])->name('auth');
Route::post('auth', [AuthController::class, 'postauth'])->name('postauth');
Route::get('LoginAuth', [AuthController::class, 'LoginAuth'])->name('LoginAuth')->middleware('logout');
Route::post('LoginAuth', [AuthController::class, 'postloginAuth'])->name('postLoginAuth');
Route::post('logoutAuth', [AuthController::class, 'logoutAuth'])->name('logoutAuth')->middleware('logout');

Route::get('alluser', [UserAuthController::class, 'index'])->name('alluser')->middleware('admin');
Route::post('alluser', [UserAuthController::class, 'phanquyen'])->name('phanquyen');




//Users
Route::prefix('User')->name('User.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('Home');

    Route::get('Lichkham', [UserController::class, 'lichkham'])->name('lichkham')->middleware('logout');
    Route::post('Lichkham', [UserController::class, 'postlichkham'])->name('postlichkham');
    Route::get('Lichkham2', [UserController::class, 'lichkham2'])->name('lichkham2')->middleware('logout');
    Route::get('huylichhen', [UserController::class, 'huylichhen'])->name('huylichhen')->middleware('logout');
    Route::post('huylichhen/{id}', [UserController::class, 'posthuylichhen'])->name('posthuylichhen');
    Route::get('sualichhen/{id}', [UserController::class, 'sualichhen'])->name('sualichhen')->middleware('logout');
    Route::post('postsualichhen/{id}', [UserController::class, 'postsualichhen'])->name('postsualichhen');

    Route::get('doctors', [UserController::class, 'doctors'])->name('doctors');
    Route::get('lienhe', [UserController::class, 'lienhe'])->name('lienhe');
    Route::post('lienhe', [UserController::class, 'postlienhe'])->name('postlienhe');
    Route::get('dichvu', [UserController::class, 'dichvu'])->name('dichvu');
    Route::get('caidattaikhoan', [UserController::class, 'Setting'])->name('Setting')->middleware('logout');
    Route::get('suatrangcanhan/{id}', [UserController::class, 'suatrangcanhan'])->name('suatrangcanhan')->middleware('logout');
    Route::post('posttrangcanhan/{id}', [UserController::class, 'posttrangcanhan'])->name('posttrangcanhan');
    Route::get('lichsukham', [UserController::class, 'lichsukham'])->name('lichsukham')->middleware('logout');

    Route::get('dangnhap', [UserController::class, 'dangnhap'])->name('dangnhap');
    Route::post('dangnhap', [UserController::class, 'postdangnhap'])->name('postdangnhap');
    Route::get('lichtruc', [UserController::class, 'lichtruc'])->name('lichtruc');

    Route::post('dangky', [UserController::class, 'dangky'])->name('dangky');
    Route::post('logout', [UserController::class, 'logout'])->name('logout')->middleware('logout');

    //doctor
    Route::get('bacsi', [UserController::class, 'bacsi'])->name('bacsi')->middleware('bacsi', 'logout');
    Route::get('lichhen', [UserController::class, 'lichhen'])->name('lichhen')->middleware('bacsi', 'logout');
    Route::get('dklichtruc', [UserController::class, 'dklichtruc'])->name('dklichtruc')->middleware('bacsi', 'logout');
    Route::post('dklichtruc', [UserController::class, 'postdklichtruc'])->name('postdklichtruc')->middleware('bacsi');
    Route::get('sualichtrucdk/{id}', [UserController::class, 'sualichtrucdk'])->name('sualichtrucdk')->middleware('bacsi', 'logout');
    Route::post('sualichtrucdk/{id}', [UserController::class, 'postsualichtrucdk'])->name('postsualichtrucdk')->middleware('bacsi');
    Route::post('xoalichtrucdk/{id}', [UserController::class, 'xoalichtrucdk'])->name('xoalichtrucdk');
    Route::get('xemlichtruc', [UserController::class, 'xemlichtrucbs'])->name('xemlichtrucbs')->middleware('bacsi', 'logout');
    Route::get('khambenh/{id}', [UserController::class, 'khambenh'])->name('khambenh')->middleware('bacsi', 'logout');
    Route::get('benhan/{id}', [UserController::class, 'benhan'])->name('benhan')->middleware('bacsi', 'logout');
    Route::post('postbenhandonthuoc', [UserController::class, 'postbenhandonthuoc'])->name('postbenhandonthuoc');
    Route::get('donthuoc/{id}', [UserController::class, 'donthuoc'])->name('donthuoc')->middleware('bacsi', 'logout');
    Route::get('trangcanhan', [UserController::class, 'trangcanhan'])->name('trangcanhan')->middleware('bacsi', 'logout');
    Route::get('suathongtin/{id}', [UserController::class, 'suathongtin'])->name('suathongtin')->middleware('bacsi', 'logout');
    Route::post('suathongtin/{id}', [UserController::class, 'postsuathongtin'])->name('postsuathongtin');
    Route::get('lichsukhambs', [UserController::class, 'lichsukhambs'])->name('lichsukhambs')->middleware('bacsi', 'logout');
});
