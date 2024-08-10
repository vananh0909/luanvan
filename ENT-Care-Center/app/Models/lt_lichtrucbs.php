<?php

namespace App\Models;

use Session;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lt_lichtrucbs extends Model
{
    use HasFactory;

    protected $table = 'lt_lichtrucbs';
    protected $primaryKey = 'lt_Idlt';
    public $timestamps = false;
    // Khai báo tên bảng trong cơ sở dữ liệu
    // Khai báo các trường có thể gán (mass assignment)
    protected $fillable = ['lt_Idlt', 'lt_ngaytruc', 'lt_giotruc'];
}
