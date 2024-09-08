<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

Route::get('sendmail', [UserController::class, 'sendmail'])->name('sendmail');



#Admin
Route::prefix('Admin')->name('Admin.')->middleware(['auth', 'checkroles'])->group(function () {
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
    Route::get('thongke', [AdminController::class, 'thongke'])->name('thongke');

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
Route::get('LoginAuth', [AuthController::class, 'LoginAuth'])->name('LoginAuth');
Route::post('LoginAuth', [AuthController::class, 'postloginAuth'])->name('postLoginAuth');
Route::post('logoutAuth', [AuthController::class, 'logoutAuth'])->name('logoutAuth');

Route::get('alluser', [UserAuthController::class, 'index'])->name('alluser')->middleware('admin');
Route::post('alluser', [UserAuthController::class, 'phanquyen'])->name('phanquyen');




//Users
Route::prefix('User')->name('User.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('Home');
    Route::get('Lichkham', [UserController::class, 'lichkham'])->name('lichkham');
    Route::post('Lichkham', [UserController::class, 'postlichkham'])->name('postlichkham');
    Route::get('Lichkham2', [UserController::class, 'lichkham2'])->name('lichkham2');
    Route::get('doctors', [UserController::class, 'doctors'])->name('doctors');
    Route::get('dichvu', [UserController::class, 'dichvu'])->name('dichvu');
    Route::get('caidattaikhoan', [UserController::class, 'Setting'])->name('Setting');
    Route::post('caidattaikhoan/{id}', [UserController::class, 'editsetting'])->name('editsetting');
    Route::get('lichsukham', [UserController::class, 'lichsukham'])->name('lichsukham');

    Route::get('dangnhap', [UserController::class, 'dangnhap'])->name('dangnhap');
    Route::post('dangnhap', [UserController::class, 'postdangnhap'])->name('postdangnhap');
    Route::get('lichtruc', [UserController::class, 'lichtruc'])->name('lichtruc');

    Route::post('dangky', [UserController::class, 'dangky'])->name('dangky');
    Route::post('logout', [UserController::class, 'logout'])->name('logout');

    //doctor
    Route::get('bacsi', [UserController::class, 'bacsi'])->name('bacsi');
    Route::get('lichhen', [UserController::class, 'lichhen'])->name('lichhen');
    Route::get('dklichtruc', [UserController::class, 'dklichtruc'])->name('dklichtruc');
    Route::post('dklichtruc', [UserController::class, 'postdklichtruc'])->name('postdklichtruc');
    Route::get('sualichtrucdk/{id}', [UserController::class, 'sualichtrucdk'])->name('sualichtrucdk');
    Route::post('sualichtrucdk/{id}', [UserController::class, 'postsualichtrucdk'])->name('postsualichtrucdk');
    Route::post('xoalichtrucdk/{id}', [UserController::class, 'xoalichtrucdk'])->name('xoalichtrucdk');
    Route::get('xemlichtruc', [UserController::class, 'xemlichtrucbs'])->name('xemlichtrucbs');
    Route::get('khambenh/{id}', [UserController::class, 'khambenh'])->name('khambenh');
    Route::post('postbenhandonthuoc', [UserController::class, 'postbenhandonthuoc'])->name('postbenhandonthuoc');
    Route::get('donthuoc/{id}', [UserController::class, 'donthuoc'])->name('donthuoc');
});
