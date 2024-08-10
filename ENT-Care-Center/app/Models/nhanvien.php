<?php

namespace App\Models;

use Session;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class nhanvien extends Model
{
    use HasFactory;
    protected $primaryKey = 'NV_Id';
    // use SoftDeletes;
    protected $table = 'nhanvien';
    public $timestamps = false;
    // Khai báo tên bảng trong cơ sở dữ liệu

    // Khai báo các trường có thể gán (mass assignment)
    protected $fillable = ['NV_Avatar', 'NV_Ten', 'NV_Birthday', 'NV_Gioitinh', 'NV_Diachi', 'NV_Email', 'NV_Sdt', 'NV_Trinhdo', 'NV_Chucvu', 'NV_Gioithieu'];
}
