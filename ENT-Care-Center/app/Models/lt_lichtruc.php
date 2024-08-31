<?php

namespace App\Models;

use Session;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lt_lichtruc extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = 'lt_lichtruc';
    protected $primaryKey = 'lt_Id';
    public $timestamps = false;


    // Khai báo các trường có thể gán
    protected $fillable = ['lt_Id', 'lt_tenbs', 'lt_Ngaytruc', 'lt_Giotruc', 'user_id'];
}
