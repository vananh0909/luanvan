<?php

namespace App\Models;

use Session;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class dv_dichvu1 extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'dv_dichvu1';
    protected $primaryKey = 'DV_ID';
    public $timestamps = false;
    // Khai báo tên bảng trong cơ sở dữ liệu

    // Khai báo các trường có thể gán (mass assignment)
    protected $fillable = ['DV_Tendv', 'DV_Gia'];
}