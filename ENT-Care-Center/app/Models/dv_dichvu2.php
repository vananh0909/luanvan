<?php

namespace App\Models;

use Session;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dv_dichvu2 extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = 'dv_dichvu2';
    protected $primaryKey = 'DV2_ID';
    public $timestamps = false;
    // Khai báo tên bảng trong cơ sở dữ liệu

    // Khai báo các trường có thể gán (mass assignment)
    protected $fillable = ['DV2_Tendv', 'DV2_anhdv', 'DV2_gioithieu'];
}